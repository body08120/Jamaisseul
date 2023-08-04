<?php
require_once('helpers/autoloader.php');

class PlaceRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findPlacesByJobId($jobId)
    {
        try {
            $sql = "SELECT p.id_place, p.name_place, p.insee_place FROM places p
                    JOIN poss_places pp ON p.id_place = pp.id_place
                    WHERE pp.id_job = :jobId";

            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);
            $stmt->execute();
            $placesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $places = array();
            foreach ($placesData as $placeData) {
                $place = new Place($placeData['id_place'], $placeData['name_place'], $placeData['insee_place']);
                $places[] = $place;
            }

            return $places;
        } catch (PDOException $e) {
            return array();
        }
    }


}