<?php
session_start();
require_once('../class/User.php');


$userRepo = new UserRepository();
$email = htmlspecialchars(strip_tags($_POST['email']));
$username = htmlspecialchars(strip_tags($_POST['username']));
$password = htmlspecialchars(strip_tags($_POST['password']));


$user = $userRepo->getUserByEmailAndUsername($email, $username);
if ($user != []) {
    if (password_verify($password, $user->getPassword())) {

        $_SESSION['username'] = $user->getUsername();
        $_SESSION['success-message'] = "Connexion réussi.";
        header('Location: panel.php');
    } else {

        $_SESSION['error-message'] = "Un des champs est incorrect.";
        header('Location: login.php');
    }
} else {

    $_SESSION['error-message'] = "Aucun utilisateur n'a été trouvé.";
    header('Location: login.php');
}
?>