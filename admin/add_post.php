<?php
session_start();
require_once('../class/Post.php');

$path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

if (!empty($_FILES['picture'])) {
    $nameFile = $_FILES['picture']['name'];
    $typeFile = $_FILES['picture']['type'];
    $tmpFile = $_FILES['picture']['tmp_name'];
    $errorFile = $_FILES['picture']['error'];
    $sizeFile = $_FILES['picture']['size'];

    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

    $extension = explode('.', $nameFile);

    $max_size = 500000;

    if (in_array($typeFile, $type)) {
        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
            if ($sizeFile <= $max_size && $errorFile == 0) {
                // if (move_uploaded_file($tmpFile, $image = '../upload/' . uniqid() . '.' . end($extension))) {
                    if (move_uploaded_file($tmpFile, '../' . $image = 'upload/' . uniqid() . '.' . end($extension))) {
                    // echo "Upload effectué !";
                } else {
                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                    header('location: admin-posts.php');
                    exit();
                }
            } else {
                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                header('location: admin-posts.php');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Merci d'uploader une image !";
            header('location: admin-posts.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Type non autorisé !";
        header('location: admin-posts.php');
        exit();
    }
}

$nom_image = $_FILES['picture']['name'];

if (isset($_POST['submit'])) {
    if (isset($_POST['title']) && isset($image) && isset($_POST['date']) && isset($_POST['desc_post'])) {
        if (!empty($_POST['title']) && !empty($image) && !empty($_POST['date']) && !empty($_POST['desc_post'])) {
            $post = new Post();
            $post->setTitle(htmlspecialchars(strip_tags($_POST['title'])));
            $post->setDate(htmlspecialchars(strip_tags($_POST['date'])));
            $post->setDescPost(htmlspecialchars(strip_tags($_POST['desc_post'])));

            try {
                $postRepository = new PostRepository();
                $postRepository->addPost($post);

                $tab_id = $postRepository->last_id();
                $id = $tab_id[0]['MAX(id)'];

                // Mettre à jour l'image dans la table posts
                $postRepository->updatePostImage($id, $nom_image, $image);

                $_SESSION['success-message'] = "L'article à bien été ajouté !";
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
}
?>