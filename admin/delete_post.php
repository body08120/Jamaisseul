<?php
session_start();

require_once('../class/Post.php');

var_dump($_POST);
// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deletePostId"
    if (isset($_POST['deletePostId'])) {

        $postId = $_POST['deletePostId'];
        try {
            $postRepository = new PostRepository();
            $postRepository->deletePost($postId);

            $_SESSION['success-message'] = "L'article a bien été supprimé";
            // echo json_encode(array('success' => true));
        } catch (Exception $e) {
            $_SESSION['error-message'] = "L'article n'a pas été supprimé";
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