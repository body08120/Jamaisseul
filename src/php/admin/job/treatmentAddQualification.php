<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que les données nécessaires sont présentes dans la requête
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        // Récupérer les données du formulaire
        $qualificationName = $_POST['name'];

        // Créer un nouvel objet Qualification
        $newQualification = new Qualification($qualificationName);

        // Enregistrer la nouvelle qualification en base de données en utilisant le QualificationRepository
        $qualificationRepository = new QualificationsRepository();
        $success = $qualificationRepository->save($newQualification);

        // Préparer la réponse JSON
        $response = array();
        if ($success) {
            $response['success'] = true;
            $response['qualification'] = array(
                'id' => $newQualification->getQualificationsId(),
                'name' => $newQualification->getQualificationsName(),
            );
        } else {
            $response['success'] = false;
            $response['message'] = 'Erreur lors de l\'ajout de la qualification.';
        }

        // Envoyer la réponse JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Répondre avec une erreur si les données requises ne sont pas présentes
        http_response_code(400);
        echo 'Des données invalides ont été soumises.';
    }
} else {
    // Répondre avec une erreur si la requête n'est pas de type POST
    http_response_code(405);
    echo 'Méthode non autorisée. Seules les requêtes POST sont acceptées.';
}
?>