<?php
require_once('helpers/autoloader.php');

class QualificationsRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAllQualifications()
    {
        $sql = "SELECT * FROM qualifications ORDER BY id_qualifications DESC";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {

            $qualifications = [];
            foreach ($datas as $data) {
                $qualification = new Qualification($data['id_qualifications'], $data['name_qualifications']);
                // $qualification->setQualificationId($data['id_qualifications']);
                // $qualification->setQualificationName($data['name_qualifications']);

                $qualifications[] = $qualification;
            }

            return $qualifications;

        } else {
            return [];
        }
    }

    public function save(Qualification $qualification)
    {
        $name = $qualification->getQualificationsName();

        $sql = "INSERT INTO qualifications (name_qualifications) VALUES (:name)";

        // Exécuter la requête préparée avec les valeurs appropriées
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        // Ajoute ici d'autres bindParam pour les autres propriétés de Qualification

        // Exécution de la requête
        $success = $stmt->execute();

        // Vérifier si l'insertion s'est bien déroulée
        if ($success) {
            // Si l'insertion est réussie, on peut mettre à jour l'objet Qualification avec l'ID généré par la base de données
            $qualification->setQualificationId($this->getDb()->lastInsertId());
            return true;
        } else {
            // Gérer les cas d'erreur d'insertion en base de données (afficher un message, journaliser l'erreur, etc.)
            return false;
        }
    }

    public function findQualificationsByJobId($jobId)
    {
        try {
            $sql = "SELECT q.id_qualifications, q.name_qualifications FROM qualifications q
                    JOIN poss_qualif pq ON q.id_qualifications = pq.id_qualifications
                    WHERE pq.id_job = :jobId";

            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
            $stmt->execute();
            $qualificationsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $qualifications = array();
            foreach ($qualificationsData as $qualificationData) {
                $qualification = new Qualification($qualificationData['id_qualifications'], $qualificationData['name_qualifications']);
                $qualifications[] = $qualification;
            }

            return $qualifications;
        } catch (PDOException $e) {
            return array();
        }
    }
}