<?php
require_once('helpers/autoloader.php');

function resetPass()
{
    //A FAIRE
    // Si pas de token, renvoyer 
    // Si token pas en db, renvoyer

    require('views/resetpass.php');
}

function treatmentResetPass()
{
    //A FAIRE
    require('src/php/admin/treatmentResetPass.php');
}

function treatmentRecupPass()
{
    require('src/php/admin/treatmentRecupPass.php');
}