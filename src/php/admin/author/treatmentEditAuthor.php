<?php
// SI L'IMAGE N'A PAS ÉTÉ CHANGÉE //
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['update_picture_author']['name'] == '') {

    if (isset($_POST['update_name_author']) && isset($_POST['update_desc_author']) && isset($_POST['update_facebook']) && isset($_POST['update_twitter']) && isset($_POST['update_pinterest']) && isset($_POST['update_id_author'])) {

        if ($_POST['update_name_author'] !== '' && $_POST['update_desc_author'] !== '' && $_POST['update_facebook'] !== '' && $_POST['update_twitter'] !== '' && $_POST['update_pinterest'] !== '' && $_POST['update_id_author'] !== '') {

            $authorId = $_POST['update_id_author'];

            try {

                // On nettoie les données
                $nameAuthor = htmlspecialchars(strip_tags(trim($_POST['update_name_author'])));
                $descAuthor = htmlspecialchars(strip_tags(trim($_POST['update_desc_author'])));
                $facebook = htmlspecialchars(strip_tags(trim($_POST['update_facebook'])));
                $twitter = htmlspecialchars(strip_tags(trim($_POST['update_twitter'])));
                $pinterest = htmlspecialchars(strip_tags(trim($_POST['update_pinterest'])));

                // Instancier un objet Post et définir ses propriétés
                $author = new Author();
                $author->setId($authorId);
                $author->setName($nameAuthor);
                $author->setDesc($descAuthor);
                $author->setFacebook($facebook);
                $author->setTwitter($twitter);
                $author->setPinterest($pinterest);

                $authorRepository = new AuthorRepository();
                $authorRepository->updateAuthor($author);


                $_SESSION['success-message'] = "L'auteur a bien été modifié !";
                header('location: index.php?admin&action=AdminAuteurs');
                exit();

            } catch (Exception $e) {

                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminAuteurs');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
        header('location: index.php?admin&action=AdminAuteurs');
        exit();
    }

    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['update_picture_author']['name'] !== '') {

    if (isset($_POST['update_name_author']) && isset($_POST['update_desc_author']) && isset($_POST['update_facebook']) && isset($_POST['update_twitter']) && isset($_POST['update_pinterest']) && isset($_POST['update_id_author']) && isset($_FILES['update_picture_author'])) {

        if ($_POST['update_name_author'] !== '' && $_POST['update_desc_author'] !== '' && $_POST['update_facebook'] !== '' && $_POST['update_twitter'] !== '' && $_POST['update_pinterest'] !== '' && $_POST['update_id_author'] !== '' && $_FILES['update_picture_author'] !== '') {

            try {

                // On nettoie les données
                $nameAuthor = htmlspecialchars(strip_tags(trim($_POST['update_name_author'])));
                $descAuthor = htmlspecialchars(strip_tags(trim($_POST['update_desc_author'])));
                $facebook = htmlspecialchars(strip_tags(trim($_POST['update_facebook'])));
                $twitter = htmlspecialchars(strip_tags(trim($_POST['update_twitter'])));
                $pinterest = htmlspecialchars(strip_tags(trim($_POST['update_pinterest'])));

                $authorId = $_POST['update_id_author'];

                // On va chercher le lien de l'image
                // $postRepository = new PostRepository();
                // $image = $postRepository->findPostById($postId);
                // $imagePath = $image->getPicture();

                $authorRepository = new AuthorRepository();
                $image = $authorRepository->getAuthorById($authorId);
                $imagePath = $image->getPicture();

                // On prépare l'url du fichier à supprimer
                $basePath = '/'; // Remplacez cette valeur par le chemin absolu de votre projet
                $path = $imagePath;
                // $path = $_SERVER['DOCUMENT_ROOT'] . '/localhost/' . $imagePath;

                // On tente de supprimer le fichier et quittons le script si il n'est pas supprimer et stockons une erreur en session
                if (!unlink($path)) {

                    $_SESSION['error-message'] = "Modification échouée, l'image n'a pas été supprimée : $path";
                    header('location: index.php?admin&action=AdminAuteurs');
                    exit;

                } else {

                    $nameFile = $_FILES['update_picture_author']['name'];
                    $typeFile = $_FILES['update_picture_author']['type'];
                    $tmpFile = $_FILES['update_picture_author']['tmp_name'];
                    $errorFile = $_FILES['update_picture_author']['error'];
                    $sizeFile = $_FILES['update_picture_author']['size'];

                    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

                    $extension = explode('.', $nameFile);

                    $max_size = 500000;


                    if (in_array($typeFile, $type)) {
                        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                            if ($sizeFile <= $max_size && $errorFile == 0) {
                                if (move_uploaded_file($tmpFile, $image = 'upload/' . uniqid() . '.' . end($extension))) {

                                    // Instancier un objet Post et définir ses propriétés
                                    $author = new Author();
                                    $author->setId($authorId);
                                    $author->setName($nameAuthor);
                                    $author->setDesc($descAuthor);
                                    $author->setFacebook($facebook);
                                    $author->setTwitter($twitter);
                                    $author->setPinterest($pinterest);
                                    $author->setPicture($image);
                                    $author->setDescPicture($nameFile);

                                    $authorRepository = new AuthorRepository();

                                    $authorRepository->updateAuthor($author);
                                    $authorRepository->updateAuthorImage($authorId, $nameFile, $image);

                                    $_SESSION['success-message'] = "L'auteur a bien été modifié !";
                                    header('location: index.php?admin&action=AdminAuteurs');
                                    exit();

                                    // echo "Upload effectué !";
                                } else {
                                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                                    header('location: index.php?admin&action=AdminAuteurs');
                                    exit();
                                }
                            } else {
                                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                                header('location: index.php?admin&action=AdminAuteurs');
                                exit();
                            }
                        } else {
                            $_SESSION['error-message'] = "Merci d'uploader une image !";
                            header('location: index.php?admin&action=AdminAuteurs');
                            exit();
                        }
                    } else {
                        $_SESSION['error-message'] = "Type non autorisé !";
                        header('location: index.php?admin&action=AdminAuteurs');
                        exit();
                    }

                }

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminAuteurs');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis ! 2";
        header('location: index.php?admin&action=AdminAuteurs');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: index.php?admin&action=AdminAuteurs');
    exit();
}
?>