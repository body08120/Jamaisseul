<?php
require_once('helpers/autoloader.php');

class Job
{
    /** @var int job identifier */
    private int $jobId;

    /**  @var string title for job */
    private string $jobTitle;

    /**  @var string category for job */
    private string $jobCategory;

    /** @var string description for job */
    private string $jobDescription;

    /** @var string picture path for job */
    private string $jobPicture;

    /** @var string picture name for job */
    private string $jobDescriptionPicture;

    /** @var string chief for job */
    private string $jobChiefLastName;

    /** @var string chief for job */
    private string $jobChiefName;

    /** @var string datecreated for job */
    private string $jobDateCreated;

    /** @var string datestarted for job */
    private string $jobDateStarted;

    /** @var array | string places  for jobs */
    private array|string $jobPlaces;

    /** @var array | string qualifications  for jobs */
    private array|string $jobQualifications;

    /** @var array | string responsabilities  for jobs */
    private array|string $jobResponsabilities;

    /**
     * Constructor for Job object
     * 
     * @param string $jobTitle
     * @param string $jobCategory
     * @param string $jobDescription Description for job
     * @param string $jobPicture Picture path for job
     * @param string $jobDesciptionPicture Name picture for job
     * @param string $chiefName Name chief for job
     * @param string $dateCreated Date created for job
     * @param string $dateStarted Date started for job
     * @param array | string $jobPlaces Places for job
     * @param array | string $jobQualifications Qualifications for job
     * @param array | string $jobResponsabilities Responsabilities for job
     * 
     */
    public function __construct(string $jobTitle, string $jobCategory, string $jobDescription, string $jobPicture, string $jobDescriptionPicture, string $jobChiefLastName, string $jobChiefName, string $jobDateCreated, string $jobDateStarted, array|string $jobPlaces, array|string $jobQualifications, array|string $jobResponsabilities)
    {
        $this->jobTitle = $jobTitle;
        $this->jobCategory = $jobCategory;
        $this->jobDescription = $jobDescription;
        $this->jobPicture = $jobPicture;
        $this->jobDescriptionPicture = $jobDescriptionPicture;
        $this->jobChiefLastName = $jobChiefLastName;
        $this->jobChiefName = $jobChiefName;
        $this->jobDateCreated = $jobDateCreated;
        $this->jobDateStarted = $jobDateStarted;

        $this->jobPlaces = $jobPlaces;
        $this->jobQualifications = $jobQualifications;
        $this->jobResponsabilities = $jobResponsabilities;
    }

    public function getJobId(): int
    {
        return $this->jobId;
    }

    /**
     * @param int $id
     */
    public function setJobId($id)
    {
        $this->jobId = $id;
    }

    public function getJobTitle(): string
    {
        return $this->jobTitle;
    }

    /**
     * @param string $title
     */
    public function setJobTitle($title)
    {
        $this->jobTitle = $title;
    }

    public function getJobCategory(): string
    {
        return $this->jobCategory;
    }

    /**
     * @param string $category
     */
    public function setJobCategory($category)
    {
        $this->jobCategory = $category;
    }

    public function getJobDescription(): string
    {
        return $this->jobDescription;
    }

    /**
     * @param string $description 
     */
    public function setJobDescription($description)
    {
        $this->jobDescription = $description;
    }

    /**
     * Get the path picture of the job.
     */
    public function getJobPicture(): string
    {
        return $this->jobPicture;
    }

    /**
     * @param string $picture The picture URL of the job.
     */
    public function setJobPicture($picture)
    {
        $this->jobPicture = $picture;
    }

    public function getJobDescriptionPicture(): string
    {
        return $this->jobDescriptionPicture;
    }

    /**
     * @param string $descriptionPicture
     */
    public function setJobDescriptionPicture($descriptionPicture)
    {
        $this->jobDescriptionPicture = $descriptionPicture;
    }

    public function getJobChiefLastName(): string
    {
        return $this->jobChiefLastName;
    }

    public function getJobChiefName(): string
    {
        return $this->jobChiefName;
    }

    /**
     * @param string $name 
     */
    public function setJobChiefName($name)
    {
        $this->jobChiefName = $name;
    }

    public function getJobDateCreated(): string
    {
        return $this->jobDateCreated;
    }

    /**
     * @param string $dateCreated
     */
    public function setJobDateCreated($dateCreated)
    {
        $this->jobDateCreated = $dateCreated;
    }

    public function getJobDateStarted(): string
    {
        return $this->jobDateStarted;
    }

    /**
     * @param string $dateStarted
     */
    public function setJobDateStarted($dateStarted)
    {
        $this->jobDateStarted = $dateStarted;
    }

    public function getJobPlaces(): array|string
    {
        return $this->jobPlaces;
    }

    /**
     * @param array | string $places 
     */
    public function setJobPlaces($places)
    {
        $this->jobPlaces = $places;
    }

    public function getJobQualifications(): array|string
    {
        return $this->jobQualifications;
    }

    /**
     * @param array | string $qualifications 
     */
    public function setJobQualifications($qualifications)
    {
        $this->jobQualifications = $qualifications;
    }

    public function getJobResponsabilities(): array|string
    {
        return $this->jobResponsabilities;
    }

    /**
     * @param array | string $responsabilities 
     */
    public function setJobResponsabilities($responsabilities)
    {
        $this->jobResponsabilities = $responsabilities;
    }


}