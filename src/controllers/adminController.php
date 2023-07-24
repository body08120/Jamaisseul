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

function viewAdminPosts()
{
    verifyAdminView();
    $postRepository = new PostRepository();

    $page = isset($_GET['page']) ? $_GET['page'] : 1; // Récupère le numéro de page depuis la requête GET
    $perPage = 10; // Nombre d'articles par page

    $offset = ($page - 1) * $perPage; // Calcul de l'offset en fonction du numéro de page

    $posts = $postRepository->findAllPosts($perPage, $offset); // Appel à la méthode findAllPosts() en passant les paramètres de pagination

    // Afficher les liens de pagination
    $totalPosts = $postRepository->getTotalPostsCount(); // Méthode pour obtenir le nombre total d'articles dans la base de données
    $totalPages = ceil($totalPosts / $perPage);

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
    $postId = $_POST['update_id_post'];
    // soucis de chargement de page du à l'absence de l'id =)

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

function treatmentUploadCkEditor()
{
    verifyAdminView();

    require('src/php/admin/treatmentCkEditUpload.php');
}



?>