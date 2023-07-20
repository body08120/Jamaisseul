<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
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
    if (!empty($_POST['password'])) {
        try {
            $idUser = $_SESSION['id_user'];
            $userRepository = new UserRepository();
            $userRepository->updatePassword($idUser, $_POST['password']);

            $_SESSION['success-message'] = "Votre mot de passe a bien été modifié !";
            header('Location: ../account.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['error-message'] = "Échec de la modification";
            header('location: ../account.php');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Le champs ne doit pas être vide !";
        header('location: ../account.php');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenu !";
    header('location: ../account.php');
    exit();
}