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
    // On vérifie qu'on est bien un parametre id en GET
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Actualites');
        exit;
    }

    // On vérifie qu'on a une valeur numérique surpérieur de 0 
    if (!ctype_digit($_GET['id']) || intval($_GET['id']) <= 0) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Actualites');
        exit;
    }

    $id = $_GET['id'];

    $postRepository = new postRepository();
    $post = $postRepository->findPostById($id);

    // On vérifie qu'un job est trouvé
    if (!$post) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Acutalites');
        exit;
    }

    // On cherche l'auteur de l'article en cours d'édition
    $authorId = $post->getAuthorId();
    $authorsRepository = new AuthorRepository();
    $author = $authorsRepository->getAuthorById($authorId);
    // var_dump($author);die;

    require('views/post.php');
}

function posts()
{
    // On vérifie on est sur quel page
    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $currentPage = (int) strip_tags($_GET['page']);
    } else {
        $currentPage = 1;
    }

    // On récupère toutes les offres d'emploi
    $postRepository = new postRepository();
    // On détermine le nombre de jobs
    $result = $postRepository->countPosts();
    // on force en nombre entier, autre sécu si on veut
    $nbPosts = (int) $result['nb_posts'];

    // On détermine le nombre de film par page
    $parPage = 6;
    $pages = ceil($nbPosts / $parPage);

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

    $posts = $postRepository->findAllPostsPagined($premier, $parPage);

    // Supposons que $post->getDate() renvoie la date au format 'Y-m-d H:i:s'

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
    // On vérifie qu'on est bien un parametre id en GET
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }

    // On vérifie qu'on a une valeur numérique surpérieur de 0 
    if (!ctype_digit($_GET['id']) || intval($_GET['id']) <= 0) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }

    $id = $_GET['id'];

    $jobRepository = new jobRepository();
    $job = $jobRepository->findJobById($id);

    // On vérifie qu'un job est trouvé
    if (!$job) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }


    // RELATIONS PART
    // On stock le nom du chef en deux partie
    $fullName = htmlspecialchars($job->getJobChiefName(), ENT_QUOTES, 'UTF-8');
    $parts = explode(' ', $fullName);

    // Si deux partie, sinon 
    if (count($parts) >= 2) {
        $lastName = $parts[0];
        $firstName = $parts[1];
    } else {
        $lastName = $fullName;
        $firstName = '';
    }

    // On stock les responsabilities
    $responsibilities = $job->getJobResponsabilities(); // Supposons que c'est la chaîne de responsabilités que vous avez récupérée
    $responsibilityList = explode('<br>', $responsibilities);

    // On stock les qualifications
    $qualifications = $job->getJobQualifications();
    $qualificationList = explode('<br>', $qualifications);

    // On affiche les données de l'objet job dans la view grâce au methode de la classe job
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
    $parPage = 6;
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