<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $password = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $newrepassword = $_POST['newrepassword'];

    //Regex parts
    $regex_length = '/^.{8,}$/'; // Au moins 8 caractères
    $regex_uppercase = '/[A-Z]/'; // Au moins une lettre majuscule
    $regex_lowercase = '/[a-z]/'; // Au moins une lettre minuscule
    $regex_digit = '/\d/'; // Au moins un chiffre
    //_

    if (!empty($password) && !empty($newpassword) && !empty($newrepassword)) {
        if ($newpassword !== $newrepassword) {

            $_SESSION['error-message'] = "Les mots de passe ne correspondent pas !";
            header('Location: index.php?admin&action=AdminCompte');
            exit; // Arrêter le script ou effectuer une autre action
        }

        if (
            !preg_match($regex_length, $newpassword) ||
            !preg_match($regex_uppercase, $newpassword) ||
            !preg_match($regex_lowercase, $newpassword) ||
            !preg_match($regex_digit, $newpassword)
        ) {

            $_SESSION['error-message'] = "Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule et un chiffre.";
            header('Location: index.php?admin&action=AdminCompte');
            exit;
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