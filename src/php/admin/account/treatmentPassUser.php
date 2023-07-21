<?php
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

require_once('src/php/token.php');
if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: index.php');
    exit; // Arrêter le script ou effectuer une autre action
}

require_once('class/User.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $newrepassword = $_POST['newrepassword'];


    if (!empty($password) && !empty($newpassword) && !empty($newrepassword)) {
        if ($newpassword !== $newrepassword) {
            $_SESSION['error-message'] = "Les mots de passe ne correspondent pas !";
            // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
            header('Location: index.php?admin&action=AdminCompte');
            exit; // Arrêter le script ou effectuer une autre action
        }

        try {
            $idUser = $_SESSION['id_user'];
            $userRepository = new UserRepository();
            $userRepository->verifyPassword($idUser, $password);
            $userRepository->updatePassword($idUser, $_POST['password']);

            $_SESSION['success-message'] = "Votre mot de passe a bien été modifié !";
            header('Location: index.php?admin&action=AdminCompte');
            exit();
        } catch (Exception $e) {
            $_SESSION['error-message'] = "Échec de la modification";
            header('location: index.php?admin&action=AdminCompte');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Le champs ne doit pas être vide !";
        header('location: index.php?admin&action=AdminCompte');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenu !";
    header('location: index.php?admin&action=AdminCompte');
    exit();
}