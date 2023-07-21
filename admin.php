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
        case 'AdminAjoutActualite':
            viewAdminAddPost();
            break;
        case 'AdminEditActualite':
            viewAdminEditPost();
            break;
        case 'TraitementChercheActualite':
            treatmentPostGet();
            break;
        case 'TraitementEditActualite':
            treatmentEditPost();
            break;
        case 'TraitementAjoutActualite':
            treatmentAddPost();
            break;
        case 'TraitementSuppressionActualite':
            treatmentDeletePost();
            break;
        case 'TraitementSuppressionActualites':
            treatmentDeletePosts();
            break;
        case 'TraitementImageAdmin':
            treatmentAccountPictureUser();
            break;
        case 'TraitementEmailAdmin':
            treatmentAccountEmailUser();
            break;
        case 'TraitementPseudoAdmin':
            treatmentAccountPseudoUser();
            break;
        case 'TraitementPassAdmin':
            treatmentAccountPassUser();
            break;
        case 'TraitementImageCkEditor':
            treatmentUploadCkEditor();
            break;
        default:
            viewAdmin();
            break;
    }
} else {
    viewAdmin();
}

?>