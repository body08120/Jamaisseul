<?php
if (isset($_GET['action']) && $_GET['action'] !== '') {
    switch ($_GET['action']) {
        case 'RecuperationMdp':
            // echo 'Traitement de récupération de mail';
            treatmentRecupPass();
            break;
        case 'ReinitialisationMdp':
            // echo 'Affichage page réinitialisation mdp';
            resetPass();
            break;
        case 'TraitementReinitialisationMdp':
            echo 'Traitement pour réinitialiser le mdp';
            treatmentResetPass();
            break;
        default:
            homepage();
            break;
    }
} else {

    homepage();
}

?>