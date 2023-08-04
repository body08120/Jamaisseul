<?php
require_once('helpers/autoloader.php');

class Responsabilitie
{
    private $responsabilitieId;

    private $responsabilitieName;


    public function __construct($responsabilitieId, $responsabilitieName)
    {
        $this->responsabilitieId = $responsabilitieId;
        $this->responsabilitieName = $responsabilitieName;
    }

    public function getResponsabilitieId()
    {
        return $this->responsabilitieId;
    }

    public function getResponsabilitieName()
    {
        return $this->responsabilitieName;
    }

    public function setResponsabilitieId($responsabilitieId)
    {
        $this->responsabilitieId = $responsabilitieId;
    }

    public function setResponsabilitieName($responsabilitieName)
    {
        $this->responsabilitieName = $responsabilitieName;
    }
}