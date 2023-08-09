<?php
require_once('helpers/autoloader.php');
class JobRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findJobById($id_job)
    {
        // Selectionner tout de la table job, on cherche les lieux avec le même id_job, les qualifications avec le même id_job, et les responsabilites avec le même id_job //
        $sql = "SELECT jobs.*,
                GROUP_CONCAT(DISTINCT places.name_place SEPARATOR ' <br> ') AS places,
                GROUP_CONCAT(DISTINCT qualifications.name_qualifications SEPARATOR ' <br> ') AS qualifications,
                GROUP_CONCAT(DISTINCT responsabilities.name_responsabilities SEPARATOR ' <br> ') AS responsabilities FROM jobs
                -- ON JOIN LES LIEUX --
                LEFT JOIN poss_places ON jobs.id_job = poss_places.id_job
                LEFT JOIN places ON places.id_place = poss_places.id_place
                -- ON JOIN LES QUALIFICATIONS --
                LEFT JOIN poss_qualif ON jobs.id_job = poss_qualif.id_job
                LEFT JOIN qualifications ON qualifications.id_qualifications = poss_qualif.id_qualifications
                -- ON JOIN LES RESPONSABILITIES --
                LEFT JOIN poss_resp ON jobs.id_job = poss_resp.id_job
                LEFT JOIN responsabilities ON responsabilities.id_responsabilities = poss_resp.id_responsabilities
                WHERE jobs.id_job = :id
                GROUP BY jobs.id_job ORDER BY id_job DESC";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':id', $id_job);
        $stmt->execute();
        $jobData = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($jobData !== false) {
            $job = new Job();
            $job->setJobId($jobData['id_job']);
            $job->setJobTitle($jobData['title_job']);
            $job->setJobDescription($jobData['desc_job']);
            $job->setJobPicture($jobData['picture_job']);
            $job->setJobDescriptionPicture($jobData['desc_picture_job']);
            $job->setJobChiefName($jobData['chief_job']);
            $job->setJobDateCreated($jobData['date_created']);
            $job->setJobDateStarted($jobData['date_started']);
            $job->setJobPlaces($jobData['places']);
            $job->setJobQualifications($jobData['qualifications']);
            $job->setJobResponsabilities($jobData['responsabilities']);

            return $job;
        } else {
            return null;
        }
    }

    public function findAllJobs()
    {
        $sql = "SELECT jobs.*,
                GROUP_CONCAT(DISTINCT places.name_place SEPARATOR ' <br> ') AS places,
                GROUP_CONCAT(DISTINCT qualifications.name_qualifications SEPARATOR ' <br> ') AS qualifications,
                GROUP_CONCAT(DISTINCT responsabilities.name_responsabilities SEPARATOR ' <br> ') AS responsabilities FROM jobs
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
            // var_dump($datas);die;
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
                $job->setJobDateCreated($data['date_created']);
                $job->setJobDateStarted($data['date_started']);

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

    public function addJob($job)
    {
        try {
            // Commencer la transaction
            $this->getDb()->beginTransaction();

            // On insère l'offre d'emploi
            $sql = "INSERT INTO jobs (title_job, desc_job, picture_job, desc_picture_job, chief_job, date_created, date_started) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->getDb()->prepare($sql);
            $stmt->execute([$job->getJobTitle(), $job->getJobDescription(), $job->getJobPicture(), $job->getJobDescriptionPicture(), $job->getJobChiefName(), $job->getJobDateCreated(), $job->getJobDateStarted()]);

            // Récupération de l'id de l'offre d'emploi insérée (si la clé primaire est auto-incrémentée)
            $jobId = $this->getDb()->lastInsertId();

            // Charger les données de code INSEE et de noms de villes à partir du fichier CSV
            $csvFilePath = 'assets/js/crud-job/locations.csv';
            $citiesData = $this->loadCitiesFromCSV($csvFilePath);

            // Stocker les relations places
            foreach ($job->getJobPlaces() as $codeInsee) {
                if (isset($citiesData[$codeInsee])) {
                    $cityName = $citiesData[$codeInsee];
                    $sql = "SELECT id_place FROM places WHERE insee_place = ?";
                    $stmt = $this->getDb()->prepare($sql);
                    $stmt->execute([$codeInsee]);
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if (!$row) {
                        // Si le lieu avec le code INSEE donné n'existe pas dans la table places,
                        // insérer le nom de la ville et le code INSEE dans la table places
                        $sql = "INSERT INTO places (insee_place, name_place) VALUES (?, ?)";
                        $stmt = $this->getDb()->prepare($sql);
                        $stmt->execute([$codeInsee, $cityName]);

                        // Récupérer l'id_place fraîchement inséré
                        $placeId = $this->getDb()->lastInsertId();
                    } else {
                        // Si le lieu avec le code INSEE donné existe déjà dans la table places,
                        // récupérer simplement l'id_place.
                        $placeId = $row['id_place'];
                    }

                    // Ensuite, insérer la relation dans la table 'poss_places'
                    $sql = "INSERT INTO poss_places (id_job, id_place) VALUES (?, ?)";
                    $stmt = $this->getDb()->prepare($sql);
                    $stmt->execute([$jobId, $placeId]);
                }
            }

            // Stocker les relations qualifications
            foreach ($job->getJobQualifications() as $qualificationId) {
                $sql = "INSERT INTO poss_qualif (id_qualifications, id_job) VALUES (?, ?)";
                $stmt = $this->getDb()->prepare($sql);
                $stmt->execute([$qualificationId, $jobId]);
            }

            // Stocker les relations responsabilities
            foreach ($job->getJobResponsabilities() as $responsabilityId) {
                $sql = "INSERT INTO poss_resp (id_job, id_responsabilities) VALUES (?, ?)";
                $stmt = $this->getDb()->prepare($sql);
                $stmt->execute([$jobId, $responsabilityId]);
            }

            // Valider la transaction
            $this->getDb()->commit();
        } catch (PDOException $e) {
            // En cas d'erreur, annuler la transaction
            $this->getDb()->rollback();
            // Lever une nouvelle exception pour être géré par le code appelant
            throw new Exception($e->getMessage());
        }
    }

    public function loadCitiesFromCSV($csvFilePath)
    {
        $citiesData = array();

        // Ouverture du fichier CSV en mode lecture ('r') et récupération du gestionnaire de fichier dans la variable $handle
        if (($handle = fopen($csvFilePath, "r")) !== false) {
            // Boucle while pour lire chaque ligne du fichier CSV jusqu'à la fin (fgetcsv renvoie false lorsque la fin du fichier est atteinte)
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                // Récupération du code INSEE de la ville à partir de la première colonne du CSV
                $codeInsee = $data[0];
                // Récupération du nom de la ville à partir de la deuxième colonne du CSV
                $cityName = $data[1] . ' ' . $data[2];


                // Assurez-vous que le code INSEE n'est pas vide avant de l'ajouter au tableau
                // Si le code INSEE n'est pas vide, ajoutez-le au tableau avec le nom de la ville comme valeur associée
                if (!empty($codeInsee)) {
                    $citiesData[$codeInsee] = $cityName;
                }
            }
            // Fermeture du fichier CSV
            fclose($handle);
        }

        // Retourner le tableau contenant les données des villes (code INSEE => nom de la ville)
        return $citiesData;
    }

    public function updateJob($job)
    {
        try {
            $sql = "UPDATE jobs
                    SET title_job = :titleJob, desc_job = :descJob, chief_job = :chiefJob, date_created = :date_created, date_started = :date_started
                    WHERE id_job = :idJob";

            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindValue(':titleJob', $job->getJobTitle(), PDO::PARAM_STR);
            $stmt->bindValue(':descJob', $job->getJobDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':chiefJob', $job->getJobChiefName(), PDO::PARAM_STR);
            $stmt->bindValue(':date_created', $job->getJobDateCreated(), PDO::PARAM_STR);
            $stmt->bindValue(':date_started', $job->getJobDateStarted(), PDO::PARAM_STR);
            $stmt->bindValue(':idJob', $job->getJobId(), PDO::PARAM_INT);

            $stmt->execute();

            // Mettre à jour les relations de qualifications
            $this->updateJobQualifications($job->getJobId(), $job->getJobQualifications());

            // Mettre à jour les relations de responsabilités
            $this->updateJobResponsabilities($job->getJobId(), $job->getJobResponsabilities());

            // Mettre à jour les relations de lieux
            $this->updateJobPlaces($job->getJobId(), $job->getJobPlaces());

            return true;
        } catch (PDOException $e) {
            // Gérer l'erreur comme tu le souhaites (affichage, journalisation, etc.)
            return false;
        }
    }

    private function updateJobQualifications($jobId, $newQualifications)
    {

        $sql = "DELETE FROM poss_qualif WHERE id_job = :jobId";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':jobId', $jobId, PDO::PARAM_INT);
        $stmt->execute();

        // Ajouter les nouvelles relations du job
        foreach ($newQualifications as $qualificationId) {
            $sql = "INSERT INTO poss_qualif (id_qualifications, id_job) VALUES (:qualificationId, :jobId)";
            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindValue(':qualificationId', $qualificationId, PDO::PARAM_INT);
            $stmt->bindValue(':jobId', $jobId, PDO::PARAM_INT);
            $stmt->execute();
        }
    }


    private function updateJobResponsabilities($jobId, $newResponsabilities)
    {

        $sql = "DELETE FROM poss_resp WHERE id_job = :jobId";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':jobId', $jobId, PDO::PARAM_INT);
        $stmt->execute();

        // Ajouter les nouvelles relations du job
        foreach ($newResponsabilities as $responsabilitieId) {
            $sql = "INSERT INTO poss_resp (id_job, id_responsabilities) VALUES (:jobId, :responsabilitieId)";
            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindValue(':jobId', $jobId, PDO::PARAM_INT);
            $stmt->bindValue(':responsabilitieId', $responsabilitieId, PDO::PARAM_INT);
            $stmt->execute();
        }

    }

    private function updateJobPlaces($jobId, $newPlaces)
    {

        // Supprimer les anciennes relations du job
        $sql = "DELETE FROM poss_places WHERE id_job = :jobId";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':jobId', $jobId, PDO::PARAM_INT);
        $stmt->execute();

        // Préparer la requête pour récupérer l'ID des lieux par leur code INSEE
        $sqlSelectPlaceId = "SELECT id_place FROM places WHERE insee_place = :insee";
        $stmtSelectPlaceId = $this->getDb()->prepare($sqlSelectPlaceId);

        // Préparer la requête pour insérer un nouveau lieu
        $sqlInsertPlace = "INSERT INTO places (name_place, insee_place) VALUES (:name, :insee)";
        $stmtInsertPlace = $this->getDb()->prepare($sqlInsertPlace);

        // On va chercher le nom de la ville
        $csvFilePath = 'assets/js/crud-job/locations.csv';
        $citiesData = $this->loadCitiesFromCSV($csvFilePath);
        // Insérer les nouvelles relations de lieux pour cet emploi
        foreach ($newPlaces as $insee) {
            if (isset($citiesData[$insee])) { 
                $cityName = $citiesData[$insee];
                $stmtSelectPlaceId->bindValue(':insee', $insee, PDO::PARAM_STR);
                $stmtSelectPlaceId->execute();
                $placeId = $stmtSelectPlaceId->fetchColumn();
                
                // Si le lieu n'existe pas, l'ajouter et récupérer son ID
                if (!$placeId) {
                    // Insérer le nouveau lieu
                    $stmtInsertPlace->bindValue(':name', $cityName, PDO::PARAM_STR);
                    $stmtInsertPlace->bindValue(':insee', $insee, PDO::PARAM_STR);
                    $stmtInsertPlace->execute();
                    $placeId = $this->getDb()->lastInsertId(); // Récupérer l'ID du lieu nouvellement inséré
                }
                
        // Insérer la nouvelle relation de lieu pour cet emploi
        $sqlInsertRelation = "INSERT INTO poss_places (id_job, id_place) VALUES (:jobId, :placeId)";
        $stmtInsertRelation = $this->getDb()->prepare($sqlInsertRelation);
        $stmtInsertRelation->bindValue(':jobId', $jobId, PDO::PARAM_INT);
        $stmtInsertRelation->bindValue(':placeId', $placeId, PDO::PARAM_INT);
        $stmtInsertRelation->execute();
            }
        }

    }

    public function updateJobImage($jobId, $imagePath, $imageName)
    {
        $sql = "UPDATE jobs SET picture_job = ?, desc_picture_job = ? WHERE id_job = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imagePath, $imageName, $jobId]);
        $stmt->closeCursor();
    }

    public function deleteJob($jobId)
{
    $sql = "DELETE FROM jobs WHERE id_job = ?";
    $stmt = $this->getDb()->prepare($sql);
    $stmt->execute([$jobId]);
}

}