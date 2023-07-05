<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    
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

$postId = $_POST['update_id_post'];


// SI L'IMAGE N'A PAS ÉTÉ CHANGÉE §§§§§§§§ //
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['picture_post']['name'] == '') {
    if (isset($_POST['update_title_post']) && isset($_POST['update_date_post']) && isset($_POST['update_content_post']) && isset($_POST['update_id_post'])) {
        if ($_POST['update_title_post'] !== '' && $_POST['update_date_post'] !== '' && $_POST['update_content_post'] !== '' && $_POST['update_id_post'] !== '') {
            try {
                // Instancier un objet Post et définir ses propriétés
                $post = new Post();
                $post->setId($_POST['update_id_post']);
                $post->setTitle($_POST['update_title_post']);
                $post->setDate($_POST['update_date_post']);
                $post->setContent($_POST['update_content_post']);

                $postRepository = new PostRepository();
                $postRepository->updatePost($post);

                $_SESSION['success-message'] = "L'article a bien été modifié !";
                header('location: editpost.php?update_id_post='.$postId);
                exit();
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: editpost.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
        header('location: editpost.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: editpost.php');
    exit();
}
?>