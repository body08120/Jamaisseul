<?php
require_once('helpers/autoloader.php');
function homepage()
{
    require('views/homepage.php');
}

function about()
{
    require('views/about.php');
}

function post()
{
    require('views/post.php');
}

function posts()
{
    require('views/posts.php');
}

function asile()
{
    require('views/asile.php');
}

function contact()
{
    require('views/contact.php');
}

function hebergement()
{
    require('views/hebergement.php');
}

function medicosocial()
{
    require('views/medicosocial.php');
}

function recrute()
{
    require('views/recrute.php');
}

function recrutement()
{
    // On vérifie on est sur quel page
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    // On récupère toutes les offres d'emploi
    $jobRepository = new JobRepository();
    // On détermine le nombre de jobs
    $result = $jobRepository->countJobs();
    // on force en nombre entier, autre sécu si on veut
    $nbJobs = (int) $result['nb_jobs'];

    // On détermine le nombre de film par page
    $parPage = 5;
    $pages = ceil($nbJobs / $parPage);

    // On vérifie si la page courante est supérieur au nombre minimum de page (1)
    if (1 > $currentPage) {
        $currentPage = 1;
    }

    // On vérifie si la page courante est inférieur au nombre de page
    if ($pages < $currentPage) {
        $currentPage = 1;
    }

    // Calcul du premier film de la page
    $premier = ($currentPage * $parPage) - $parPage;

    $jobs = $jobRepository->findAllJobPagined($premier, $parPage);

    require('views/recrutement.php');
}

function service()
{
    require('views/service.php');
}

function login()
{
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

        header('Location: index.php');
    }

    require_once('src/php/token.php');
    require('views/login.php');
}

function treatmentLogin()
{
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

        header('Location: index.php');
    }

    require_once('src/php/token.php');
    if (verifyNotCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
        // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
        header('Location: index.php?action=login');
        exit; // Arrêter le script ou effectuer une autre action
    }

    require('src/php/admin/treatmentLogin.php');
}

function treatmentLogout()
{
    require('src/php/admin/treatmentLogout.php');
}
?>