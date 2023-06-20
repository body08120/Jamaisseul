<?php
session_start();
require_once('../class/Post.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['updateTitle']) || isset($_POST['updateDate']) || isset($_POST['updateEnunciate'])) {
        if ($_POST['updateTitle'] !== '' && $_POST['updateDate'] !== '' && $_POST['updateEnunciate'] !== '') {
            // On traite ici 
            $post = new Post();
            $post->setId($_POST['updateId']);
            $post->setTitle($_POST['updateTitle']);
            $post->setDate($_POST['updateDate']);
            $post->setDescPost($_POST['updateEnunciate']);

            var_dump($post);

            $id = $post->getId();
            $title = $post->getTitle();
            $desc = $post->getDescPost();
            $date = $post->getDate();

            $postRepository = new PostRepository();
            try {
                $postRepository->updateTitle($id, $title);
                $postRepository->updateDate($id, $date);
                $postRepository->updateDescPost($id, $desc);

                $_SESSION['success-message'] = "L'article à bien été modifié !";
                header('location: admin-posts.php');
                exit();
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
            header('location: admin-posts.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
        header('location: admin-posts.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: admin-posts.php');
    exit();
}
?>