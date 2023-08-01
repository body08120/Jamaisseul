<?php
require_once('helpers/autoloader.php');

class Qualification
{
    private $qualificationId;

    private $qualificationName;


    public function __construct()
    {

    }

    public function getQualificationsId()
    {
        return $this->qualificationId;
    }

    public function getQualificationsName()
    {
        return $this->qualificationName;
    }

    public function setQualificationId($qualificationId)
    {
        $this->qualificationId = $qualificationId;
    }

    public function setQualificationName($qualificationName)
    {
        $this->qualificationName = $qualificationName;
    }
}