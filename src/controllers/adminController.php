<?php
require_once('helpers/autoloader.php');

// Function to verify autorization for loading pages 
function verifyAdminView()
{
    if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {

        header('Location: index.php');
    }

    require_once('src/php/token.php');

    if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
        $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
        // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
        header('Location: index.php');
        exit; // Arrêter le script ou effectuer une autre action
    }
}

// Function controller 
function viewAdmin()
{
    verifyAdminView();
    require('views/admin/adminpage.php');
}

// Account controller
function viewAdminAccount()
{
    verifyAdminView();
    $userRepository = new UserRepository();
    $user = $userRepository->getUserByUserName($_SESSION['username']);

    require('views/admin/account.php');
}

function treatmentAccountPictureUser()
{
    verifyAdminView();

    require('src/php/admin/account/treatmentPictureUser.php');
}

function treatmentAccountEmailUser()
{
    verifyAdminView();

    require('src/php/admin/account/treatmentEmailUser.php');
}

function treatmentAccountPseudoUser()
{
    verifyAdminView();

    require('src/php/admin/account/treatmentPseudoUser.php');
}

function treatmentAccountPassUser()
{
    verifyAdminView();

    require('src/php/admin/account/treatmentPassUser.php');
}

function treatmentPostGet()
{
    // Traitement différent de la méthode verify car on renvoie une reponse qu'attend l'ajax
    if (!isset($_SESSION['username']) && empty($_SESSION['username'])) {
        // Renvoyer une réponse d'erreur si l'article n'existe pas
        header("HTTP/1.0 404 Not Found");
        echo "Une erreur est survenue.";
        exit;
    }

    require_once('src/php/token.php');
    if (verifyNotCSRFToken($_SESSION['csrf_token'])) {
        $_SESSION['error-message'] = "Une erreur d'authentication est survenue !";
        // Jeton CSRF non valide, arrêter le script ou afficher un message d'erreur
        // Renvoyer une réponse d'erreur si l'article n'existe pas
        header("HTTP/1.0 404 Not Found");
        echo "Erreur d'authentification.";
        exit; // Arrêter le script ou effectuer une autre action
    }

    require('src/php/admin/post/treatmentPostGet.php');
}

// Posts controller
function viewAdminPosts()
{
    verifyAdminView();
    $postRepository = new PostRepository();
    $posts = $postRepository->findAllPosts();

    require('views/admin/adminposts.php');
}

function viewAdminAddPost()
{
    verifyAdminView();
    $authorsRepository = new AuthorRepository();
    $authors = $authorsRepository->GetAllAuthor();

    require('views/admin/addpost.php');
}

function treatmentAddPost()
{
    verifyAdminView();

    require('src/php/admin/post/treatmentPostAdd.php');
}

function viewAdminEditPost()
{
    verifyAdminView();
    if (empty($_POST['update_id_post']) && isset($_POST['update_id_post'])) {

        $_SESSION['error-message'] = "Une erreur est survenue !";
        header('Location: index.php?admin&action=AdminActualites');
        exit; // Arrêter le script ou effectuer une autre action
    }
    $postId = $_POST['update_id_post'];

    // On cherche les articles en db
    $postRepository = new PostRepository();
    $post = $postRepository->findPostById($postId);

    // On cherche les auteurs en db
    $authorsRepository = new AuthorRepository();
    $authors = $authorsRepository->GetAllAuthor();

    // On cherche l'auteur de l'article en cours d'édition
    $authorId = $post->getAuthorId();
    $author = $authorsRepository->getAuthorById($authorId);

    require('views/admin/editpost.php');
}

function treatmentEditPost()
{
    verifyAdminView();

    require('src/php/admin/post/treatmentPostEdit.php');
}

function treatmentDeletePost()
{
    verifyAdminView();

    require('src/php/admin/post/treatmentPostDelete.php');
}

function treatmentDeletePosts()
{
    verifyAdminView();

    require('src/php/admin/post/treatmentPostsDelete.php');
}


function treatmentUploadCkEditor()
{
    verifyAdminView();

    require('src/php/admin/treatmentCkEditUpload.php');
}

// Jobs controller
function viewAdminJobs()
{
    verifyAdminView();
    $jobRepository = new JobRepository();
    $jobs = $jobRepository->findAllJobs();

    require('views/admin/adminjobs.php');
}


function viewAdminAddJob()
{
    verifyAdminView();

    $qualificationRepository = new QualificationsRepository();
    $qualifications = $qualificationRepository->findAllQualifications();

    $responsabilitieRepository = new ResponsabilitieRepository();
    $responsabilities = $responsabilitieRepository->findAllResponsabilities();

    require('views/admin/addjob.php');
}

function treatmentAddQualification()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentAddQualification.php');
}

function treatmentAddResponsabilitie()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentAddResponsabilitie.php');
}

function treatmentAddJob()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentAddJob.php');
}

function viewAdminEditJob()
{
    verifyAdminView();

    if (empty($_POST['updateJobId']) && isset($_POST['updateJobId'])) {

        $_SESSION['error-message'] = "Une erreur est survenue !";
        header('Location: index.php?admin&action=AdminEmplois');
        exit; // Arrêter le script ou effectuer une autre action
    }

    $jobId = $_POST['updateJobId'];

    // On set les qualif/Resp de la db 
    $qualificationRepository = new QualificationsRepository();
    $qualifications = $qualificationRepository->findAllQualifications();
    $responsabilitieRepository = new ResponsabilitieRepository();
    $responsabilities = $responsabilitieRepository->findAllResponsabilities();

    // On cherche les articles en db
    $jobRepository = new jobRepository();
    $job = $jobRepository->findJobById($jobId);

    $placeRepository = new placeRepository();
    $placesSelected = $placeRepository->findPlacesByJobId($jobId);

    $qualificationsRepository = new qualificationsRepository();
    $qualificationsSelected = $qualificationsRepository->findQualificationsByJobId($jobId);

    $responsabilitieRepository = new ResponsabilitieRepository();
    $responsabilitiesSelected = $responsabilitieRepository->FindResponsabilitiesByJobId($jobId);

    require('views/admin/editjob.php');
}

function treatmentEditJob()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentEditJob.php');
}

function treatmentDeleteJob()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentJobDelete.php');
}

function treatmentDeleteJobs()
{
    verifyAdminView();

    require('src/php/admin/job/treatmentJobsDelete.php');
}

?>