<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username']))
{
    header('Location: ../');
}

require_once('../class/Post.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_title_post']) && isset($_POST['update_desc_post']) && isset($_POST['update_date_post']) && isset($_POST['update_content_post']) && isset($_POST['update_text_post']) && isset($_POST['update_outro_post']) && isset($_POST['update_author_post']) && isset($_POST['update_id_post'])) {
        if ($_POST['update_title_post'] !== '' && $_POST['update_desc_post'] !== '' && $_POST['update_date_post'] !== '' && $_POST['update_content_post'] !== '' && $_POST['update_text_post'] !== '' && $_POST['update_outro_post'] !== '' && $_POST['update_author_post'] !== '' && $_POST['update_id_post'] !== '') {
            try {
                // Instancier un objet Post et définir ses propriétés
                $post = new Post();
                $post->setId($_POST['update_id_post']);
                $post->setTitle($_POST['update_title_post']);
                $post->setDescPost($_POST['update_desc_post']);
                $post->setDate($_POST['update_date_post']);
                $post->setContent($_POST['update_content_post']);
                $post->setText($_POST['update_text_post']);
                $post->setOutro($_POST['update_outro_post']);
                $post->setAuthor($_POST['update_author_post']);

                $postRepository = new PostRepository();
                $postRepository->updatePost($post);

                $_SESSION['success-message'] = "L'article a bien été modifié !";
                header('location: admin-posts.php');
                exit();
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: admin-posts.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
        header('location: admin-posts.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: admin-posts.php');
    exit();
}
?>