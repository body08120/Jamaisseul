<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('src/controllers/homeController.php');
require_once('src/controllers/adminController.php');
require_once('src/controllers/resetController.php');

// Si 'action' est présent en GET ET différent de vide ET que 'admin' ou 'reset' n'est pas en GET
if (isset($_GET['action']) && $_GET['action'] !== '' && !isset($_GET['admin']) && !isset($_GET['reset'])) {
    switch ($_GET['action']) {
        case 'Information':
            about();
            break;
        case 'Actualite':
            post();
            break;
        case 'Actualites':
            posts();
            break;
        case 'Asile':
            asile();
            break;
        case 'Contact':
            contact();
            break;
        case 'Hebergement':
            hebergement();
            break;
        case 'MedicoSocial':
            medicosocial();
            break;
        case 'Recrutement':
            recrute();
            break;
        case 'Recrutements':
            recrutement();
            break;
        case 'Services':
            service();
            break;
        case 'Connexion':
            login();
            break;
        case 'TraitementConnexion':
            treatmentLogin();
            break;
        case 'TraitementDeconnexion':
            treatmentLogout();
            break;
        default:
        homepage();
            break;
    }
} elseif (isset($_GET['admin']) && !empty($_SESSION)) { //  && $_SESSION['id_role'] == 1)
    
    require('admin.php');
} elseif (isset($_GET['reset'])) {

    require('reset.php');
    
} else {

    homepage();
}

?>