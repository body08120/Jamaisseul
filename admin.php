<?php
require_once('src/controllers/adminController.php');

if (isset($_GET['action']) && $_GET['action'] !== '') {
    switch ($_GET['action']) {
        case 'AdminCompte':
            viewAdminAccount();
            break;
        case 'AdminActualites':
            viewAdminPosts();
            break;
        case 'AdminAjoutActualites':
            viewAdminAddPost();
            break;
        case 'AdminEditActualites':
            viewAdminEditPost();
            break;
        default:
            viewAdmin();
            break;
    }
} else {
    viewAdmin();
}

?>