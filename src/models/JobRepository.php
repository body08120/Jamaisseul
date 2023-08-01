<?php
require_once('helpers/autoloader.php');
class JobRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAllJobs()
    {
        $sql = "SELECT jobs.*,
                GROUP_CONCAT(DISTINCT places.name_place SEPARATOR '<br>') AS places,
                GROUP_CONCAT(DISTINCT qualifications.name_qualifications SEPARATOR '<br>') AS qualifications,
                GROUP_CONCAT(DISTINCT responsabilities.name_responsabilities SEPARATOR '<br>') AS responsabilities FROM jobs
                -- ON JOIN LES LIEUX --
                LEFT JOIN poss_places ON jobs.id_job = poss_places.id_job
                LEFT JOIN places ON places.id_place = poss_places.id_place
                -- ON JOIN LES QUALIFICATIONS --
                LEFT JOIN poss_qualif ON jobs.id_job = poss_qualif.id_job
                LEFT JOIN qualifications ON qualifications.id_qualifications = poss_qualif.id_qualifications
                -- ON JOIN LES RESPONSABILITIES --
                LEFT JOIN poss_resp ON jobs.id_job = poss_resp.id_job
                LEFT JOIN responsabilities ON responsabilities.id_responsabilities = poss_resp.id_responsabilities
                
                GROUP BY jobs.id_job ORDER BY id_job DESC";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {
            // Boucle sur les données
            $jobs = [];
            foreach ($datas as $data) {
                $job = new Job;
                $job->setJobId($data['id_job']);
                $job->setJobTitle($data['title_job']);
                $job->setJobDescription($data['desc_job']);
                $job->setJobPicture($data['picture_job']);
                $job->setJobDescriptionPicture($data['desc_picture_job']);
                $job->setJobChiefName($data['chief_job']);
                $job->setJobDateCreated($data['date_start']);
                $job->setJobDateStarted($data['date_end']);

                // Ajouter les lieux associés à l'offre d'emploi
                $places = explode('<br>', $data['places']);
                $job->setJobPlaces($places);

                // Ajouter les qualifications associées à l'offre d'emploi
                $qualifications = explode('<br>', $data['qualifications']);
                $job->setJobQualifications($qualifications);

                // Ajouter les responsabilités associées à l'offre d'emploi
                $responsabilities = explode('<br>', $data['responsabilities']);
                $job->setJobResponsabilities($responsabilities);

                $jobs[] = $job;
            }
            return $jobs;
        } else {
            return [];
        }
    }
}