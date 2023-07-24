<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username'])) {
        try {
            $userRepository = new UserRepository();
            $idUser = $_SESSION['id_user'];
            $userRepository->updateUsername($idUser, $_POST['username']);

            $_SESSION['success-message'] = "Votre nom d'utilisateur a bien été modifié !";
            header('Location: index.php?admin&action=AdminCompte');
            exit();
        } catch (Exception $e) {
            $_SESSION['error-message'] = "Échec de la modification !";
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