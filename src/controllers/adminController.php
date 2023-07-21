<?php
function viewAdmin()
{
    require('views/admin/adminpage.php');
}

function viewAdminPosts()
{
    require('views/admin/adminposts.php');
}

function viewAdminAddPost()
{
    require('views/admin/addpost.php');
}

function treatmentAddPost()
{
    require('src/php/admin/post/treatmentPostAdd.php');
}

function viewAdminEditPost()
{
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

function treatmentPostGet()
{
    require('src/php/admin/post/treatmentPostGet.php');
}

function treatmentUploadCkEditor()
{
    require('src/php/admin/treatmentCkEditUpload.php');
}



?>