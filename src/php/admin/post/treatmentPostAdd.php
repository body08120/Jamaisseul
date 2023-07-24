<?php
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: index.php');
}

require_once('src/php/token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

require_once('class/Post.php');
require_once('class/Author.php');


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
                if (move_uploaded_file($tmpFile, $image = 'upload/' . uniqid() . '.' . end($extension))) {
                    // echo "Upload effectué !";
                } else {
                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                    header('location: index.php?admin&action=AdminAjoutActualite');
                    exit();
                }
            } else {
                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                header('location: index.php?admin&action=AdminAjoutActualite');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Merci d'uploader une image !";
            header('location: index.php?admin&action=AdminAjoutActualite');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Type non autorisé !";
        header('location: index.php?admin&action=AdminAjoutActualite');
        exit();
    }
}

$nom_image = $_FILES['picture_post']['name'];

if (isset($_POST['submit'])) {
    if (isset($_POST['title_post']) && isset($image) && isset($_POST['date_post']) && isset($_POST['content_post']) && isset($_POST['author_id'])) {
        if (!empty($_POST['title_post']) && !empty($image) && !empty($_POST['date_post']) && !empty($_POST['content_post']) && !empty($_POST['author_id'])) {

            $post = new Post();
            $post->setTitle(htmlspecialchars(strip_tags($_POST['title_post'])));
            $post->setDate(htmlspecialchars(strip_tags($_POST['date_post'])));
            $post->setContent($_POST['content_post']);             
            $post->setAuthorId(htmlspecialchars(strip_tags($_POST['author_id'])));

            try {
                $postRepository = new PostRepository();         
                $postRepository->addPost($post);

                $id = $postRepository->getDb()->lastInsertId();
                $postRepository->updatePostImage($id, $nom_image, $image);

                $_SESSION['success-message'] = "L'article a bien été ajouté !";
                header('location: index.php?admin&action=AdminActualites');
                exit();

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
            header('location: index.php?admin&action=AdminAjoutActualite');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
        header('location: index.php?admin&action=AdminAjoutActualite');
        exit();
    }
}
?>