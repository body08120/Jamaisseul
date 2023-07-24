<?php
require_once('class/Post.php');
require_once('class/Author.php');
require_once('class/User.php');

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
    require('src/php/admin/post/treatmentPostEdit.php');
}

function treatmentDeletePost()
{
    require('src/php/admin/post/treatmentPostDelete.php');
}

function treatmentDeletePosts()
{
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
    require('src/php/admin/account/treatmentPictureUser.php');
}

function treatmentAccountEmailUser()
{
    require('src/php/admin/account/treatmentEmailUser.php');
}

function treatmentAccountPseudoUser()
{
    require('src/php/admin/account/treatmentPseudoUser.php');
}

function treatmentAccountPassUser()
{
    require('src/php/admin/account/treatmentPassUser.php');
}

function treatmentPostGet()
{
    require('src/php/admin/post/treatmentPostGet.php');
}

function treatmentUploadCkEditor()
{
    require('src/php/admin/treatmentCkEditUpload.php');
}



?>