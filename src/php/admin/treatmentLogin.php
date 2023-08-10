<?php
// Inclure votre UserRepository ici
$userRepo = new UserRepository();

// Valider et nettoyer les entrées utilisateur
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$username = trim($_POST['username']);
$password = $_POST['password'];

// Vérifier si les champs obligatoires sont remplis
if (empty($username) || empty($password)) {
    $_SESSION['error-message'] = "Nom d'utilisateur et mot de passe requis.";
    header('Location: index.php?action=Connexion');
    exit;
}

// Vérifier si l'email est valide
if ($email === false) {
    $_SESSION['error-message'] = "Adresse email non valide.";
    header('Location: index.php?action=Connexion');
    exit;
}

// Rechercher l'utilisateur par email et nom d'utilisateur
$user = $userRepo->getUserByEmailAndUsername($email, $username);

// Vérifier si un utilisateur a été trouvé
if ($user !== null) {
    // Vérifier le mot de passe
    if (password_verify($password, $user->getPassword())) {
        // Authentification réussie
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['id_user'] = $user->getIdUser();
        $_SESSION['success-message'] = "Connexion réussie.";
        header('Location: index.php?admin&action=');
        exit;
    } else {
        // Mot de passe incorrect
        $_SESSION['error-message'] = "Erreur de connexion.";
        header('Location: index.php?action=Connexion');
        exit;
    }
} else {
    // Aucun utilisateur trouvé
    $_SESSION['error-message'] = "Erreur de connexion.";
    header('Location: index.php?action=Connexion');
    exit;
}
?>
