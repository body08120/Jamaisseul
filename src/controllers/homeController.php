<?php

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
    require('views/post.php');
}

function posts()
{
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

function recrute()
{
    require('views/recrute.php');
}

function recrutement()
{
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
    require('views/login.php');
}

function treatmentLogin()
{
    require('src/php/admin/treatmentLogin.php');
}

function treatmentLogout()
{
    require('src/php/admin/treatmentLogout.php');
}
?>