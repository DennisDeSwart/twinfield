<?php

namespace PhpTwinfield\DomDocuments;

use PhpTwinfield\Project;
use PhpTwinfield\ProjectQuantity;

/**
 * The Document Holder for making new XML projects. Is a child class
 * of DOMDocument and makes the required DOM tree for the interaction in
 * creating a new project.
 *
 * @package PhpTwinfield
 * @subpackage Invoice\DOM
 * @author Dennis de Swart <dennis@dennisdeswart.nl>
 * @author Leon Rowland <leon@rowland.nl>
 */
class ProjectsDocument extends BaseDocument
{
    /**
     * Multiple projects can be created at once by enclosing them by the dimensions element.
     *
     * @return string
     */
    protected function getRootTagName(): string
    {
        return 'dimensions';
    }

    /**
     * Turns a passed Project class into the required markup for interacting
     * with Twinfield.
     *
     * @param Project $project
     */
    public function addProject(Project $project): void
    {
        $projectEl = $this->createElement("dimension");

        // Elements and their associated methods for project
        $projectTags = array(
            'code' => 'getCode',
            'name' => 'getName',
            'shortname' => 'getShortName',
            'type' => 'getType',
            'office' => 'getOffice',
            'inuse' => 'getInUse',
            'behaviour' => 'getBehaviour',
            'touched' => 'getTouched',
        );

        if ($project->getOffice()) {
            $projectTags['office'] = 'getOffice';
        }

        if (!empty($project->getStatus())) {
            $projectEl->setAttribute('status', $project->getStatus());
        }

        // Go through each project element and use the assigned method
        foreach ($projectTags as $tag => $method) {

            if ($value = $project->$method()) {
                // Make text node for method value
                $node = $this->createTextNode($value);

                // Make the actual element and assign the node
                $element = $this->createElement($tag);
                $element->appendChild($node);

                // Add the full element
                $projectEl->appendChild($element);
            }
        }

        $this->rootElement->appendChild($projectEl);
    }
}
