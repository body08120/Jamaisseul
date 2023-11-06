<?php
if (isset($_GET['action']) && $_GET['action'] !== '') {
    switch ($_GET['action']) {
        case 'TraitementEditAuteur';
            treatmentEditAuthor();
            break;
        case 'TraitementAjoutAuteur':
            treatmentAddAuthor();
            break;
        case 'AdminEditAuteur':
            viewAdminEditAuthor();
            break;
        case 'AdminAjoutAuteur':
            viewAdminAddAuthor();
            break;
        case 'AdminAuteurs':
            viewAdminAuthors();
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
        case 'TraitementImageCkEditor':
            treatmentUploadCkEditor();
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
        case 'AdminCompte':
            viewAdminAccount();
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
        case 'AdminEmplois':
            viewAdminJobs();
            break;
        case 'AdminAjoutEmploi':
            viewAdminAddJob();
            break;
        case 'AdminAjoutQualificationJob':
            treatmentAddQualification();
            break;
        case 'AdminAjoutResponsabiliteJob':
            treatmentAddResponsabilitie();
            break;
        case 'TraitementAjoutEmploi':
            treatmentAddJob();
            break;
        case 'AdminEditionEmploi':
            viewAdminEditJob();
            break;
        case 'TraitementEditEmploi':
            treatmentEditJob();
            break;
        case 'TraitementSuppressionEmploi':
            treatmentDeleteJob();
            break;
        case 'TraitementSuppressionEmplois':
            treatmentDeleteJobs();
            break;
        default:
            viewAdmin();
            break;
    }
} else {
    viewAdmin();
}

?>