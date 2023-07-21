<?php
if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
    header('Location: index.php?action=login');
}

require_once('src/php/token.php');
if (verifyNotCSRFToken($_POST['csrf_token'])) {
    $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
    // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
    header('Location: index.php?action=login');
    exit; // Arrêter le script ou effectuer une autre action
}

session_destroy();
header('Location: index.php');