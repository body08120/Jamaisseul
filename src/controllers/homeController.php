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

    // MISE A JOUR DU CODE FUTUR --------=====
    // SOLUTION: SI ON CREER UNE TABLE CATEGORIE LIE A JOB // 
    // Créer 3 pagination bien distinct car on est sur la même page avec 3 pagination différentes.
    // ON RÉCUP CHAQUE JOBS POUR CHAQUE CATÉGORIES 
    // jobHebergement -> Paginé stocker AllJobHebergementPagined 
    // jobMedicoSocial -> Paginé stocker AllJobMedicoSocial
    // jobAsile -> Paginé stocker AllJobAsile
    // Reprendre le même principe de pagination, divisé en 3, voir si solution + optimisé !!
    // Ce qui donnera 3 variables jobs comme ligne 200 

    // Dans la vue on change chaque foreach car ceux-ci ne valent plus rien.
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