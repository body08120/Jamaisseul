<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $userId = $_POST['user_id'];
    $token = $_POST['token'];
    $newpassword = htmlspecialchars(strip_tags(trim($_POST['newpassword'])));
    $newrepassword = htmlspecialchars(strip_tags(trim($_POST['newrepassword'])));
    
    //Regex parts
    $regex_length = '/^.{8,}$/'; // Au moins 8 caractères
    $regex_uppercase = '/[A-Z]/'; // Au moins une lettre majuscule
    $regex_lowercase = '/[a-z]/'; // Au moins une lettre minuscule
    $regex_digit = '/\d/'; // Au moins un chiffre
    //_

    if (empty($_POST['newpassword']) || empty($_POST['newrepassword']) || empty($_POST['user_id'])) {

        $_SESSION['error-message'] = "Veuillez remplir tout les champs.";
        header('Location: index.php?reset=' . $token . '&action=ReinitialisationMdp');
        exit;
    }

    if (
        !preg_match($regex_length, $newpassword) ||
        !preg_match($regex_uppercase, $newpassword) ||
        !preg_match($regex_lowercase, $newpassword) ||
        !preg_match($regex_digit, $newpassword)
    ) {

        $_SESSION['error-message'] = "Le mot de passe doit contenir au moins 8 caractères, dont au moins une lettre majuscule, une lettre minuscule et un chiffre.";
        header('Location: index.php?reset=' . $token . '&action=ReinitialisationMdp');
        exit;
    }

    if ($newpassword !== $newrepassword) {

        $_SESSION['error-message'] = "Les mots de passe ne correspondent pas !";
        header('Location: index.php?admin&action=AdminCompte');
        exit;
    }

    try {
        $userRepository = new UserRepository();
        $userRepository->updatePassword($userId, $newpassword);
        $userRepository->deleteTokenFromDatabase($token);

        $_SESSION['success-message'] = "Votre mot de passe a bien été modifié !";
        header('Location: index.php?&action=Connexion');
        exit();
    } catch (Exception $e) {

        $_SESSION['error-message'] = "Échec de la modification";
        header('location: index.php?reset=' . $token . '&action=ReinitialisationMdp');
        exit();
    }

} else {

    $_SESSION['error-message'] = "Une erreur est survenue lors du chargement.";
    header('location: index.php?reset=' . $token . '&action=ReinitialisationMdp');
    exit();
}