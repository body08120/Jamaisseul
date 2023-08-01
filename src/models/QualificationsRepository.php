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
                $qualification = new Qualification();
                $qualification->setQualificationId($data['id_qualifications']);
                $qualification->setQualificationName($data['name_qualifications']);

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
}