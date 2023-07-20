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

$path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

if (!empty($_FILES['picture_post'])) {
    $nameFile = $_FILES['picture_post']['name'];
    $typeFile = $_FILES['picture_post']['type'];
    $tmpFile = $_FILES['picture_post']['tmp_name'];
    $errorFile = $_FILES['picture_post']['error'];
    $sizeFile = $_FILES['picture_post']['size'];

    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

    $extension = explode('.', $nameFile);

    $max_size = 500000;

    if (in_array($typeFile, $type)) {
        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
            if ($sizeFile <= $max_size && $errorFile == 0) {
                // if (move_uploaded_file($tmpFile, $image = '../upload/' . uniqid() . '.' . end($extension))) {
                if (move_uploaded_file($tmpFile, '../../' . $image = 'upload/' . uniqid() . '.' . end($extension))) {
                    // echo "Upload effectué !";
                } else {
                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                    header('location: addpost.php');
                    exit();
                }
            } else {
                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                header('location: addpost.php');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Merci d'uploader une image !";
            header('location: addpost.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Type non autorisé !";
        header('location: addpost.php');
        exit();
    }
}

$nom_image = $_FILES['picture_post']['name'];


if (isset($_POST['submit'])) {
    if (isset($_POST['title_post']) && isset($image) && isset($_POST['date_post']) && isset($_POST['content_post'])) {
        if (!empty($_POST['title_post']) && !empty($image) && !empty($_POST['date_post']) && !empty($_POST['content_post'])) {
            $post = new Post();
            $post->setTitle(htmlspecialchars(strip_tags($_POST['title_post'])));
            $post->setDate(htmlspecialchars(strip_tags($_POST['date_post'])));
            $post->setContent($_POST['content_post']);


            try {
                $postRepository = new PostRepository();
                $postRepository->addPost($post);

                $id = $postRepository->getDb()->lastInsertId();

                // Mettre à jour l'image dans la table posts
                $postRepository->updatePostImage($id, $nom_image, $image);

                $_SESSION['success-message'] = "L'article a bien été ajouté !";
                header('location: ../posts.php');
                exit();
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
            header('location: addpost.php');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
        header('location: addpost.php');
        exit();
    }
}
?>