<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['emailRecup'];
    $userRepository = new UserRepository();

    try {
        $emailExists = $userRepository->verifyEmailExists($email);

        if ($emailExists) {
            // Étape 1: Générer un jeton de réinitialisation
            $token = bin2hex(random_bytes(32)); // Génère un jeton de 32 octets

            // Étape 2: Enregistrer le jeton dans la base de données pour cet utilisateur
            $userRepository->saveResetToken($email, $token);

            // Étape 3: Envoyer l'email de réinitialisation contenant le lien avec le jeton
            $resetLink = "http://www.votresite.com/reset-password.php?token=" . $token;
            $emailSubject = "Réinitialisation de mot de passe";
            $emailBody = "Cliquez sur le lien suivant pour réinitialiser votre mot de passe : " . $resetLink;
            $headers = "From: noreply@votresite.com";

            if (mail($email, $emailSubject, $emailBody, $headers)) {
                // L'email a été envoyé avec succès
                // http://localhost/index.php?action=
                $_SESSION['success-message'] = "Votre demande a bien été prise en compte. Un email contenant le lien de réinitialisation de votre mot de passe vous a été envoyé.";
                header('location: index.php?action=Connexion');
                exit();

            } else {
                // Erreur lors de l'envoi de l'email
                $lastError = error_get_last();
                $_SESSION['error-message'] = "Une erreur est survenue lors de l'envoi de l'email : " . $lastError['message'];
                header('location: index.php?action=Connexion');
                exit();
            }
        } else {
            // L'email n'existe pas en base de données.
            $_SESSION['error-message'] = "Aucun compte associé à cet email.";
            header('location: index.php?action=Connexion');
            exit();
        }

    } catch (\Exception $e) {
        $_SESSION['error-message'] = "Une erreur est survenue lors de la réinitialisation du mot de passe.";
        header('location: index.php?action=Connexion');
        exit();
    }
} else {
    $_SESSION['error-message'] = "Une erreur est survenue lors de l'envoi.";
    header('location: index.php?action=Connexion');
    exit();
}