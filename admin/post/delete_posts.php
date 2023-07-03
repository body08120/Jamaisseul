<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username']))
{
    header('Location: ../../');
}

require_once('../../class/Post.php');

// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deletePostIds"
    if (isset($_POST['deletePostIds'])) {

        $postIds = explode('-', $_POST['deletePostIds']);

        try {

            foreach ($postIds as $postId) {
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
            }

            $_SESSION['success-message'] = "Les articles ont été supprimés avec succès";
            // echo json_encode(array('success' => true));
        } catch (Exception $e) {
            $_SESSION['error-message'] = "Les articles n'ont pas été supprimé";
            exit();
            // echo json_encode(array('success' => false, 'message' => "Erreur : " . $e->getMessage()));
        }

    } else {
        $_SESSION['error-message'] = "Une erreur est survenue dans la selection des articles";
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue dans le traitement des données";
    exit();
}


?>