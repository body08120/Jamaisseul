<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username']))
{
    header('Location: ../../');
}

require_once('../token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: ../index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

require_once('../../class/Post.php');

// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deletePostId"
    if (isset($_POST['deletePostId'])) {
        $postId = $_POST['deletePostId'];
        try {
            $postRepository = new PostRepository();
            $image = $postRepository->findPostById($postId);
            $imagePath = $image->getPicture();

            $basePath = '../../'; // Remplacez cette valeur par le chemin absolu de votre projet
            $path = $basePath . $imagePath;

            if (!unlink($path)) {
                $_SESSION['error-message'] = "L'image n'a pas été supprimée : $path";
                exit;
            }
            $postRepository->deletePost($postId);

            $_SESSION['success-message'] = "L'article a bien été supprimé";

        } catch (Exception $e) {
            $_SESSION['error-message'] = "L'article n'a pas été supprimé";
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Une erreur est survenue dans la sélection des articles";
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue dans le traitement des données";
    exit();
}

?>