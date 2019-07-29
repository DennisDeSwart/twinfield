<?php

namespace PhpTwinfield\ApiConnectors;

use PhpTwinfield\Project;
use PhpTwinfield\DomDocuments\ProjectsDocument;
use PhpTwinfield\Exception;
use PhpTwinfield\Mappers\ProjectMapper;
use PhpTwinfield\Office;
use PhpTwinfield\Request as Request;
use PhpTwinfield\Response\MappedResponseCollection;
use PhpTwinfield\Response\Response;
use Webmozart\Assert\Assert;

/**
 * A facade to make interaction with the the Twinfield service easier when trying to retrieve or send information about
 * Projects.
 *
 * If you require more complex interactions or a heavier amount of control over the requests to/from then look inside
 * the methods or see the advanced guide detailing the required usages.
 *
 * @author Dennis de Swart <dennis@dennisdeswart.nl>
 * @author Leon Rowland <leon@rowland.nl>
 */
class ProjectApiConnector extends BaseApiConnector
{
    /**
     * Requests a specific project based off the passed in code and the office.
     *
     * @param string $code
     * @param Office $office
     * @return Project The requested project
     * @throws Exception
     */
    public function get(string $code, Office $office): Project
    {
        // Make a request to read a single project. Set the required values
        $request_project = new Request\Read\Project();
        $request_project
            ->setOffice($office->getCode())
            ->setCode($code);

        // Send the Request document and set the response to this instance.
        $response = $this->sendXmlDocument($request_project);
        return ProjectMapper::map($response);
    }

    /**
     * Requests all projects from the List Dimension Type.
     *
     * @param Office $office
     * @return array A multidimensional array in the following form:
     *               [$projectId => ['name' => $name, 'shortName' => $shortName], ...]
     *
     * @throws Exception
     */
    public function listAll(Office $office): array
    {
        // Make a request to a list of all projects
        $request_projects = new Request\Catalog\Dimension($office, "PRJ");

        // Send the Request document and set the response to this instance.
        $response = $this->sendXmlDocument($request_projects);

        // Get the raw response document
        $responseDOM = $response->getResponseDocument();

        // Prepared empty project array
        $projects = [];

        // Store in an array by project id
        /** @var \DOMElement $project */
        foreach ($responseDOM->getElementsByTagName('dimension') as $project) {
            $project_id = $project->textContent;

            if ($project_id == "PRJ") {
                continue;
            }

            $projects[$project->textContent] = array(
                'name' => $project->getAttribute('name'),
                'shortName' => $project->getAttribute('shortname'),
            );
        }

        return $projects;
    }

    /**
     * Sends a \PhpTwinfield\Project\Project instance to Twinfield to update or add.
     *
     * @param Project $project
     * @return Project
     * @throws Exception
     */
    public function send(Project $project): Project
    {
        $projectResponses = $this->sendAll([$project]);

        Assert::count($projectResponses, 1);

        foreach ($projectResponses as $projectResponse) {
            return $projectResponse->unwrap();
        }
    }

    /**
     * @param Project[] $projects
     * @return MappedResponseCollection
     * @throws Exception
     */
    public function sendAll(array $projects): MappedResponseCollection
    {
        Assert::allIsInstanceOf($projects, Project::class);

        $responses = [];

        foreach ($this->getProcessXmlService()->chunk($projects) as $chunk) {

            $projectsDocument = new ProjectsDocument();

            foreach ($chunk as $project) {
                $projectsDocument->addProject($project);
            }

            $responses[] = $this->sendXmlDocument($projectsDocument);
        }

        return $this->getProcessXmlService()->mapAll($responses, "dimension", function (Response $response): Project {
            return ProjectMapper::map($response);
        });
    }
}
