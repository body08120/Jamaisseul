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

    // On cherche les articles suivant et précédent
    $precPost = $postRepository->getPrecPostById($id);
    $nextPost = $postRepository->getNextPostById($id);
    // Vérifier si l'article précédent existe
    if (!$precPost) {
        $precPost = null;
    }

    // Vérifier si l'article suivant existe
    if (!$nextPost) {
        $nextPost = null;
    }

    // On cherche les derniers articles poster
    $latestPosts = $postRepository->getLatestPosts();


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

/**
 * Display the detailed view of a job offer (recruitment).
 */
function recrute()
{
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }

    // Numeric value and positive number  
    if (!ctype_digit($_GET['id']) || intval($_GET['id']) <= 0) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }

    $id = htmlspecialchars(trim($_GET['id']));

    $jobRepository = new jobRepository();
    $job = $jobRepository->findJobById($id);

    if (!$job) {
        $_SESSION['error-message'] = "Une erreur est survenue.";
        header('Location: index.php?action=Recrutements');
        exit;
    }

    // RELATIONS PART

    $responsibilities = $job->getJobResponsabilities();
    $responsibilityList = explode('<br>', $responsibilities);

    $qualifications = $job->getJobQualifications();
    $qualificationList = explode('<br>', $qualifications);


    require('views/recrute.php');
}

function recrutement()
{
    // Récupération des paramètres
    $currentPage = isset($_GET['page']) && !empty($_GET['page']) ? (int) $_GET['page'] : 1;
    $currentCategory = isset($_GET['category']) ? $_GET['category'] : 'hebergement';

    // On récupère toutes les offres d'emploi
    $jobRepository = new JobRepository();

    // Un tableau pour stocker les offres d'emploi par catégorie
    $categories = ['hébergement', 'médico-social', 'asile'];
    $jobsByCategory = [];

// Définissez un tableau associatif pour stocker les données de pagination pour chaque catégorie
$paginationData = [];

foreach ($categories as $category) {
    // On détermine le nombre de jobs pour la catégorie
    $result = $jobRepository->countJobsByCategory($category);
    $nbJobs = (int) $result['nb_jobs'];

    // On vérifie si le nombre total d'offres d'emploi est supérieur à zéro
    if ($nbJobs > 0) {
        // On détermine le nombre d'emplois par page
        $parPage = 6;
        $pages = ceil($nbJobs / $parPage);

        // On vérifie si la page courante est supérieure au nombre minimum de pages (1)
        $currentPageCategory = isset($_GET['page']) && !empty($_GET['page']) ? (int) $_GET['page'] : 1;

        if ($currentPageCategory < 1) {
            $currentPageCategory = 1;
        }

        // On vérifie si la page courante est supérieure au nombre de pages
        if ($currentPageCategory > $pages) {
            $currentPageCategory = $pages;
        }

        // Calcul du premier job de la page
        $premier = ($currentPageCategory - 1) * $parPage;

        // On récupère les jobs paginés pour la catégorie
        $jobs = $jobRepository->findAllJobPaginedByCategory($premier, $parPage, $category);

        // On stocke les offres d'emploi dans le tableau associatif
        $jobsByCategory[$category] = $jobs;

        // On stocke les données de pagination dans le tableau associatif
        $paginationData[$category] = [
            'currentPage' => $currentPageCategory,
            'totalPages' => $pages,
        ];

    } else {
        // Aucune pagination nécessaire si le nombre total d'offres d'emploi est zéro
        $jobsByCategory[$category] = [];
        $paginationData[$category] = [
            'currentPage' => 1,
            'totalPages' => 1,
        ];
    }
}



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

    require_once('views/login.php');
}

function treatmentLogin(): void
{
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {

        header('Location: index.php');
    }
    require_once('src/php/token.php');

    if (verifyNotCSRFToken($_POST['csrf_token'])) {
        $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
        header('Location: index.php?action=Connexion');
        exit;
    }

    require('src/php/admin/treatmentLogin.php');
}

function treatmentLogout()
{
    require('src/php/admin/treatmentLogout.php');
}
?>