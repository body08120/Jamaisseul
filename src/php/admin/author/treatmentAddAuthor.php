<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name_author']) && isset($_POST['desc_author']) && isset($_POST['facebook']) && isset($_POST['twitter']) && isset($_POST['pinterest']) && isset($_FILES['picture_author'])) {
        if ($_POST['name_author'] !== '' && $_POST['desc_author'] !== '' && $_POST['facebook'] !== '' && $_POST['twitter'] !== '' && $_POST['pinterest'] !== '' && $_FILES['picture_author']['name'] !== '') {

            // On nettoie les données
            $nameAuthor = htmlspecialchars(strip_tags(trim($_POST['name_author'])));
            $descAuthor = htmlspecialchars(strip_tags(trim($_POST['desc_author'])));
            $facebook = htmlspecialchars(strip_tags(trim($_POST['facebook'])));
            $twitter = htmlspecialchars(strip_tags(trim($_POST['twitter'])));
            $pinterest = htmlspecialchars(strip_tags(trim($_POST['pinterest'])));

            // Vérification de l'image et son upload
            $path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

            try {

                if (!empty($_FILES['picture_author'])) {
                    $nameFile = $_FILES['picture_author']['name'];
                    $typeFile = $_FILES['picture_author']['type'];
                    $tmpFile = $_FILES['picture_author']['tmp_name'];
                    $errorFile = $_FILES['picture_author']['error'];
                    $sizeFile = $_FILES['picture_author']['size'];

                    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

                    $extension = explode('.', $nameFile);

                    $max_size = 500000;

                    if (in_array($typeFile, $type)) {
                        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                            if ($sizeFile <= $max_size && $errorFile == 0) {
                                if (move_uploaded_file($tmpFile, $picture = 'upload/' . uniqid() . '.' . end($extension))) {
                                    // echo "Upload effectué !";

                                } else {
                                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                                    header('location: index.php?admin&action=AdminAjoutAuteur');
                                    exit();
                                }
                            } else {
                                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                                header('location: index.php?admin&action=AdminAjoutAuteur');
                                exit();
                            }
                        } else {
                            $_SESSION['error-message'] = "Merci d'uploader une image !";
                            header('location: index.php?admin&action=AdminAjoutAuteur');
                            exit();
                        }
                    } else {
                        $_SESSION['error-message'] = "Type non autorisé !";
                        header('location: index.php?admin&action=AdminAjoutAuteur');
                        exit();
                    }
                }

                $descPicture = htmlspecialchars(strip_tags(trim($_FILES['picture_author']['name'])));

                // On instancie notre objet 'job'
                $author = new Author();
                $author->setName($nameAuthor);
                $author->setDesc($descAuthor);
                $author->setFacebook($facebook);
                $author->setTwitter($twitter);
                $author->setPinterest($pinterest);
                $author->setPicture($picture);
                $author->setDescPicture($descPicture);

                // var_dump($author);die;

                $authorRepository = new AuthorRepository();
                $authorRepository->addAuthor($author);

                $_SESSION['success-message'] = "Votre auteur a bien été ajouté !";
                header('location: index.php?admin&action=AdminAuteurs');
                exit();

            } catch (Exception $e) {

                $_SESSION['error-message'] = $e->getMessage();
                header('location: index.php?admin&action=AdminAjoutAuteur');
                exit();
            }


        } else {
            $_SESSION['error-message'] = "Aucun champs ne doit être vide !";
            header('location: index.php?admin&action=AdminAjoutAuteur');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Veillez à remplir tout les champs !";
        header('location: index.php?admin&action=AdminAjoutAuteur');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: index.php?admin&action=AdminAjoutAuteur');
    exit();
}
?>