<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email'])) {
        try {
            $idUser = $_SESSION['id_user'];
            $userRepository = new UserRepository();
            $userRepository->updateEmail($idUser, $_POST['email']);

            $_SESSION['success-message'] = "Votre email a bien été modifié !";
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