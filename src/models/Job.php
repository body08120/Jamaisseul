<?php
require_once('helpers/autoloader.php');

class Job
{

    private $jobId;

    private $jobTitle;

    private $jobDescription;

    private $jobPicture;

    private $jobDescriptionPicture;

    private $jobChiefName;

    private $jobDateCreated;

    private $jobDateStarted;

    private $jobPlaces;

    private $jobQualifications;

    private $jobResponsabilities;

    public function __construct()
    {
    }

    public function getJobId()
    {
        return $this->jobId;
    }

    public function setJobId($id)
    {
        $this->jobId = $id;
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    public function setJobTitle($title)
    {
        $this->jobTitle = $title;
    }

    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    public function setJobDescription($description)
    {
        $this->jobDescription = $description;
    }

    public function getJobPicture()
    {
        return $this->jobPicture;
    }

    public function setJobPicture($picture)
    {
        $this->jobPicture = $picture;
    }

    public function getJobDescriptionPicture()
    {
        return $this->jobDescriptionPicture;
    }

    public function setJobDescriptionPicture($descriptionPicture)
    {
        $this->jobDescriptionPicture = $descriptionPicture;
    }

    public function getJobChiefName()
    {
        return $this->jobChiefName;
    }

    public function setJobChiefName($name)
    {
        $this->jobChiefName = $name;
    }

    public function getJobDateCreated()
    {
        return $this->jobDateCreated;
    }

    public function setJobDateCreated($dateCreated)
    {
        $this->jobDateCreated = $dateCreated;
    }

    public function getJobDateStarted()
    {
        return $this->jobDateStarted;
    }

    public function setJobDateStarted($dateStarted)
    {
        $this->jobDateStarted = $dateStarted;
    }

    public function getJobPlaces()
    {
        return $this->jobPlaces;
    }

    public function setJobPlaces($places)
    {
        $this->jobPlaces = $places;
    }

    public function getJobQualifications()
    {
        return $this->jobQualifications;
    }

    public function setJobQualifications($qualifications)
    {
        $this->jobQualifications = $qualifications;
    }

    public function getJobResponsabilities()
    {
        return $this->jobResponsabilities;
    }

    public function setJobResponsabilities($responsabilities)
    {
        $this->jobResponsabilities = $responsabilities;
    }

}