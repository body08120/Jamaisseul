<?php
// Étape 1: Génération du jeton CSRF
function generateCSRFToken() {
    return bin2hex(random_bytes(32));
}

// Étape 2: Stockage du jeton CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = generateCSRFToken();
}

// Étape 3: Injection du jeton CSRF dans les formulaires
function injectCSRFToken() {
    echo '<input type="hidden" name="csrf_token" value="' . $_SESSION['csrf_token'] . '">';
}

// Étape 4: Vérification du jeton CSRF
function verifyNotCSRFToken($token) {
    return !isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token'];
}
?>