<?php
require_once('helpers/autoloader.php');

function treatmentRecupPass()
{
    require('src/php/treatmentRecupPass.php');
}

function resetPass()
{
    if (!isset($_GET['reset']) && $_GET['reset'] == '') {

        header('Location: index.php');
    }
    $token = $_GET['reset'];

    $userRepository = new UserRepository();
    if (!$userRepository->verifyTokenResetPasswordExist($token)) {

        $_SESSION['error-message'] = "Le lien de réinitialisation n'est pas valide.";
        header('Location: index.php?action=Connexion');
        exit;
    }
    if (!$userRepository->verifyTokenResetPasswordExpired($token)) {

        $userRepository->deleteTokenFromDatabase($token);

        $_SESSION['error-message'] = "Le lien de réinitialisation à expiré.";
        header('Location: index.php?action=Connexion');
        exit;
    }

    $userId = $userRepository->findUserByToken($token);
    if (!$userId) {

        $_SESSION['error-message'] = "Utilisateur introuvable.";
        header('Location: index.php?action=Connexion');
        exit;
    }

    require('views/resetpass.php');
}

function treatmentResetPass()
{
    require('src/php/treatmentResetPass.php');
}