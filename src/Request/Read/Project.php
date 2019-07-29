<?php

namespace PhpTwinfield\Request\Read;

/**
 * Used to request a specific custom from a certain
 * office and code.
 *
 * @package PhpTwinfield
 * @subpackage Request\Read
 * @author Dennis de Swart <dennis@dennisdeswart.nl>
 * @author Leon Rowland <leon@rowland.nl>
 */
class Project extends Read
{
    /**
     * Sets the <type> to dimensions for the request and
     * sets the dimtype, office and code if they are present.
     *
     * @access public
     */
    public function __construct($office = null, $code = null, $dimType = 'PRJ')
    {
        parent::__construct();

        $this->add('type', 'dimensions');

        if (null !== $office) {
            $this->setOffice($office);
        }

        if (null !== $code) {
            $this->setCode($code);
        }

        $this->setDimType($dimType);
    }

    /**
     * Sets the office code for this project request.
     *
     * @access public
     * @param int $office
     * @return \PhpTwinfield\Request\Read\Project
     */
    public function setOffice($office)
    {
        $this->add('office', $office);
        return $this;
    }

    /**
     * Sets the code for this project request.
     *
     * @access public
     * @param string $code
     * @return \PhpTwinfield\Request\Read\Project
     */
    public function setCode($code)
    {
        $this->add('code', $code);
        return $this;
    }

    /**
     * Sets the dimtype for the request.
     *
     * @access public
     * @param string $dimType
     * @return \PhpTwinfield\Request\Read\Project
     */
    public function setDimType($dimType)
    {
        $this->add('dimtype', $dimType);
        return $this;
    }
}
