<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error-message'] = "Une erreur est survenue";
    header('Location: index.php?action=Connexion');
    exit;
}

// Valider et nettoyer les entrées utilisateur
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$username = htmlspecialchars(strip_tags(trim($_POST['username'])));
$password = htmlspecialchars(strip_tags(trim($_POST['password'])));
$captcha = $_POST['g-recaptcha-response'];

// Vérifier si les champs obligatoires sont remplis
if (empty($username) || empty($password)) {
    if ($username !== '' || $password !== '') {
        $_SESSION['error-message'] = "Tous les champs sont obligatoires";
        header('Location: index.php?action=Connexion');
        exit;
    }
}

if (empty($captcha)) {
    $_SESSION['error-message'] = "Erreur de vérification du captcha.";
    header('Location: index.php?action=Connexion');
    exit;
}

// Vérifier si l'email est valide
if ($email === false) {
    $_SESSION['error-message'] = "Adresse email non valide.";
    header('Location: index.php?action=Connexion');
    exit;
}

/* Check Google captch validation */
if (isset($captcha)) {
    $error_message = validation_google_captcha($captcha);
    if ($error_message !== '') {
        $_SESSION['error-message'] = "Validation reCAPTCHA échouée : " . $error_message;
        header('Location: index.php?action=Connexion');
        exit;
    }
}
/*
 * Validate google captch
 */
function validation_google_captcha($captch_response)
{

    /* Replace google captcha secret key*/
    $captch_secret_key = '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe';

    $data = array(
        'secret' => $captch_secret_key,
        'response' => $captch_response,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    $verify = curl_init();
    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($verify, CURLOPT_POST, true);
    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($verify);
    $response = json_decode($response, true);
    $error_message = '';
    if (isset($response['error-codes']) && !empty($response['error-codes'])) {
        if ($response['error-codes'][0] == 'missing-input-secret') {

            $error_message = '<p>The recaptcha secret parameter is missing.</p>';

        } elseif ($response['error-codes'][0] == 'invalid-input-secret') {

            $error_message = '<p>The recaptcha secret parameter is invalid or malformed.</p>';

        } elseif ($response['error-codes'][0] == 'missing-input-response') {

            $error_message = '<p>The recaptcha response parameter is missing.</p>';

        } elseif ($response['error-codes'][0] == 'invalid-input-response') {

            $error_message = '<p>The recaptcha response parameter is invalid or malformed.</p>';

        } elseif ($response['error-codes'][0] == 'bad-request') {

            $error_message = '<p>The recaptcha request is invalid or malformed.</p>';
        }
    }
    if ($error_message != '') {
        return $error_message;
    } else {
        return '';
    }
}

// Rechercher l'utilisateur par email et nom d'utilisateur
$userRepo = new UserRepository();
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