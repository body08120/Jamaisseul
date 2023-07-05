<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: ../');
    exit();
}

require_once('../token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: ../index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

require_once('../../class/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

    if (!empty($_FILES['userPicture'])) {
        $nameFile = $_FILES['userPicture']['name'];
        $typeFile = $_FILES['userPicture']['type'];
        $tmpFile = $_FILES['userPicture']['tmp_name'];
        $errorFile = $_FILES['userPicture']['error'];
        $sizeFile = $_FILES['userPicture']['size'];

        $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
        $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

        $extension = explode('.', $nameFile);
        $imageName = $_FILES['userPicture']['name'];

        $max_size = 500000;

        if (in_array($typeFile, $type)) {
            if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                if ($sizeFile <= $max_size && $errorFile == 0) {
                    if (move_uploaded_file($tmpFile, '../../' . $image = 'upload/' . uniqid() . '.' . end($extension))) {

                        $username = $_SESSION['username'];
                        $userRepository = new UserRepository();
                        $userRepository->updateUserPicture($username, $imageName, $image);

                        $_SESSION['success-message'] = "L'image à bien été modifier";
                        header('location: ../account.php');
                        exit();

                    } else {
                        $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                        header('location: ../account.php');
                        exit();
                    }
                } else {
                    $_SESSION['error-message'] = "Le poids de l'image est trop élevé !";
                    header('location: ../account.php');
                    exit();
                }
            } else {
                $_SESSION['error-message'] = "Merci d'uploader une image !";
                header('location: ../account.php');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Type non autorisé !";
            header('location: ../account.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Échec de l'upload de l'image !";
        header('location: ../account.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
    header('location: ../account.php');
    exit();
}