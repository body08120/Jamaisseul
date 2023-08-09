<?php
// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deleteJobId"
    if (isset($_POST['deleteJobId'])) {
        $jobId = $_POST['deleteJobId'];
        try {
            $jobRepository = new JobRepository();
            $image = $jobRepository->findJobById($jobId);
            $imagePath = $image->getJobPicture();

            $path = $imagePath;

            if (!unlink($path)) {
                $_SESSION['error-message'] = "L'image n'a pas été supprimée : $path";
                header('Location: index.php?admin&action=AdminEmplois');
                exit;
            }
            $jobRepository->deleteJob($jobId);

            $_SESSION['success-message'] = "L'offre d'emploi a bien été supprimée";
            header('Location: index.php?admin&action=AdminEmplois');

        } catch (Exception $e) {
            $_SESSION['error-message'] = "L'offre d'emploi n'a pas été supprimée";
            header('Location: index.php?admin&action=AdminEmplois');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Une erreur est survenue dans la sélection des offres d'emploi";
        header('Location: index.php?admin&action=AdminEmplois');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue dans le traitement des données";
    exit();
}

 ?>