<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['emailRecup'];
    $userRepository = new UserRepository();

    try {
        $emailExists = $userRepository->verifyEmailExists($email);

        if ($emailExists) {
            $token = bin2hex(random_bytes(32));

            $resetLink = "http://www.votresite.com/reset-password.php?token=" . $token;
            $emailSubject = "Réinitialisation de mot de passe";
            $emailBody = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : " . $resetLink;
            $headers = "From: noreply@votresite.com";

            if (mail($email, $emailSubject, $emailBody, $headers)) {
                $_SESSION['success-message'] = "Votre demande a bien été prise en compte. Un email contenant le lien de réinitialisation de votre mot de passe vous a été envoyé.";
                $userRepository->saveResetToken($email, $token);
                header('location: index.php?action=Connexion');
                exit();

            } else {
                $lastError = error_get_last();
                $_SESSION['error-message'] = "Une erreur est survenue lors de l'envoi de l'email : " . $lastError['message'];
                header('location: index.php?action=Connexion');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Une erreur est survenue.";
            header('location: index.php?action=Connexion');
            exit();
        }

    } catch (\Exception $e) {
        $_SESSION['error-message'] = "Une erreur est survenue lors de la demande de réinitialisation du mot de passe.";
        header('location: index.php?action=Connexion');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue.";
    header('location: index.php?action=Connexion');
    exit();
}