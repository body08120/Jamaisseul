<?php
session_start();
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: ../');
    exit();
}

require_once('../../class/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        try {
            $idUser = $_SESSION['id_user'];
            $userRepository = new UserRepository();
            $userRepository->updateEmail($idUser, $_POST['email']);

            $_SESSION['success-message'] = "Votre email a bien été modifié !";
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