<?php


$postId = $_POST['update_id_post'];

// SI L'IMAGE N'A PAS ÉTÉ CHANGÉE //
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['update_picture_post']['name'] == '') {

    if (isset($_POST['update_title_post']) && isset($_POST['update_date_post']) && isset($_POST['update_content_post']) && isset($_POST['update_id_post']) && isset($_POST['update_author_id'])) {

        if ($_POST['update_title_post'] !== '' && $_POST['update_date_post'] !== '' && $_POST['update_content_post'] !== '' && $_POST['update_id_post'] !== '' && $_POST['update_author_id'] !== '') {

            try {

                // Instancier un objet Post et définir ses propriétés
                $post = new Post();
                $post->setId($_POST['update_id_post']);
                $post->setTitle($_POST['update_title_post']);
                $post->setDate($_POST['update_date_post']);
                $post->setContent($_POST['update_content_post']);
                
                $post->setAuthorId($_POST['update_author_id']);

                $postRepository = new PostRepository();
                $postRepository->updatePost($post);

                $_SESSION['success-message'] = "L'article a bien été modifié !";
                header('location: index.php?admin&action=AdminActualites');
                exit();

            } catch (Exception $e) {

                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminActualites');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
        header('location: index.php?admin&action=AdminActualites');
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_FILES['update_picture_post']['name'] !== '') {

    if (isset($_POST['update_title_post']) && isset($_POST['update_date_post']) && isset($_POST['update_content_post']) && isset($_POST['update_id_post']) && isset($_FILES['update_picture_post'])) {

        if ($_POST['update_title_post'] !== '' && $_POST['update_date_post'] !== '' && $_POST['update_content_post'] !== '' && $_POST['update_id_post'] !== '' && $_FILES['update_picture_post'] !== '') {

            try {

                // On va chercher le lien de l'image
                $postRepository = new PostRepository();
                $image = $postRepository->findPostById($postId);
                $imagePath = $image->getPicture();

                // On prépare l'url du fichier à supprimer
                $basePath = '/'; // Remplacez cette valeur par le chemin absolu de votre projet
                $path = $imagePath;
                // $path = $_SERVER['DOCUMENT_ROOT'] . '/localhost/' . $imagePath;

                // On tente de supprimer le fichier et quittons le script si il n'est pas supprimer et stockons une erreur en session
                if (!unlink($path)) {

                    $_SESSION['error-message'] = "Modification échouée, l'image n'a pas été supprimée : $path";
                    header('location: index.php?admin&action=AdminActualites');
                    exit;

                } else {

                    $nameFile = $_FILES['update_picture_post']['name'];
                    $typeFile = $_FILES['update_picture_post']['type'];
                    $tmpFile = $_FILES['update_picture_post']['tmp_name'];
                    $errorFile = $_FILES['update_picture_post']['error'];
                    $sizeFile = $_FILES['update_picture_post']['size'];

                    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
                    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

                    $extension = explode('.', $nameFile);

                    $max_size = 500000;


                    if (in_array($typeFile, $type)) {
                        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
                            if ($sizeFile <= $max_size && $errorFile == 0) {
                                if (move_uploaded_file($tmpFile, $image = 'upload/' . uniqid() . '.' . end($extension))) {

                                    // Instancier un objet Post et définir ses propriétés
                                    $post = new Post();
                                    $post->setId($_POST['update_id_post']);
                                    $post->setTitle($_POST['update_title_post']);
                                    $post->setDate($_POST['update_date_post']);
                                    $post->setPicture($image);
                                    $post->setDescPicture($nameFile);
                                    $post->setContent($_POST['update_content_post']);


                                    $postRepository = new PostRepository();
                                    $postRepository->deletePicture($postId);

                                    $postRepository->updatePost($post);

                                    // Mettre à jour l'image dans la table posts
                                    $postRepository->updatePostImage($postId, $nameFile, $image);

                                    // $postRepository->updatePostAndPicture($post);

                                    $_SESSION['success-message'] = "L'article a bien été modifié !";
                                    header('location: index.php?admin&action=AdminActualites');
                                    exit();

                                    // echo "Upload effectué !";
                                } else {
                                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                                    header('location: index.php?admin&action=AdminActualites');
                                    exit();
                                }
                            } else {
                                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                                header('location: index.php?admin&action=AdminActualites');
                                exit();
                            }
                        } else {
                            $_SESSION['error-message'] = "Merci d'uploader une image !";
                            header('location: index.php?admin&action=AdminActualites');
                            exit();
                        }
                    } else {
                        $_SESSION['error-message'] = "Type non autorisé !";
                        header('location: index.php?admin&action=AdminActualites');
                        exit();
                    }

                }

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }

        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplis !";
            header('location: index.php?admin&action=AdminActualites');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplis ! 2";
        header('location: index.php?admin&action=AdminActualites');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue !";
    header('location: index.php?admin&action=AdminActualites');
    exit();
}
?>