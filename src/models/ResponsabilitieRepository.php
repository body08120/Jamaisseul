<?php
require_once('helpers/autoloader.php');

class ResponsabilitieRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAllResponsabilities()
    {
        $sql = "SELECT * FROM responsabilities ORDER BY id_responsabilities DESC";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {

            $responsabilities = [];
            foreach ($datas as $data) {
                $responsabilitie = new Responsabilitie($data['id_responsabilities'], $data['name_responsabilities']);
                // $responsabilitie->setResponsabilitieId($data['id_responsabilities']);
                // $responsabilitie->setResponsabilitieName($data['name_responsabilities']);

                $responsabilities[] = $responsabilitie;
            }

            return $responsabilities;

        } else {
            return [];
        }
    }

    public function save(Responsabilitie $responsabilitie)
    {
        $name = $responsabilitie->getResponsabilitieName();

        $sql = "INSERT INTO responsabilities (name_responsabilities) VALUES (:name)";

        // Exécuter la requête préparée avec les valeurs appropriées
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        // Exécution de la requête
        $success = $stmt->execute();

        // Vérifier si l'insertion s'est bien déroulée
        if ($success) {
            // Si l'insertion est réussie, on peut mettre à jour l'objet Qualification avec l'ID généré par la base de données
            $responsabilitie->setResponsabilitieId($this->getDb()->lastInsertId());
            return true;
        } else {
            // Gérer les cas d'erreur d'insertion en base de données (afficher un message, journaliser l'erreur, etc.)
            return false;
        }
    }

    public function findResponsabilitiesByJobId($jobId)
    {
        try {
            $sql = "SELECT r.id_responsabilities, r.name_responsabilities FROM responsabilities r
                    JOIN poss_resp pr ON r.id_responsabilities = pr.id_responsabilities
                    WHERE pr.id_job = :jobId";

            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
            $stmt->execute();
            $responsabilitiesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $responsabilities = array();
            foreach ($responsabilitiesData as $responsabilitieData) {
                $responsabilitie = new Responsabilitie($responsabilitieData['id_responsabilities'], $responsabilitieData['name_responsabilities']);
                $responsabilities[] = $responsabilitie;
            }

            return $responsabilities;
        } catch (PDOException $e) {
            return array();
        }
    }
}