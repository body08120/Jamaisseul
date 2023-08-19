<?php
$path = $_SERVER['DOCUMENT_ROOT'] . 'upload/';

if (!empty($_FILES['picture_post'])) {
    $nameFile = $_FILES['picture_post']['name'];
    $typeFile = $_FILES['picture_post']['type'];
    $tmpFile = $_FILES['picture_post']['tmp_name'];
    $errorFile = $_FILES['picture_post']['error'];
    $sizeFile = $_FILES['picture_post']['size'];

    $extensions = ['png', 'jpg', 'jpeg', 'gif', 'jiff'];
    $type = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/jiff'];

    $extension = explode('.', $nameFile);

    $max_size = 500000;

    if (in_array($typeFile, $type)) {
        if (count($extension) <= 2 && in_array(strtolower(end($extension)), $extensions)) {
            if ($sizeFile <= $max_size && $errorFile == 0) {
                // if (move_uploaded_file($tmpFile, $image = '../upload/' . uniqid() . '.' . end($extension))) {
                if (move_uploaded_file($tmpFile, $image = 'upload/' . uniqid() . '.' . end($extension))) {
                    // echo "Upload effectué !";
                } else {
                    $_SESSION['error-message'] = "Échec de l'upload de l'image !";
                    header('location: index.php?admin&action=AdminAjoutActualite');
                    exit();
                }
            } else {
                $_SESSION['error-message'] = "Erreur : le poids de l'image est trop élevé !";
                header('location: index.php?admin&action=AdminAjoutActualite');
                exit();
            }
        } else {
            $_SESSION['error-message'] = "Merci d'uploader une image !";
            header('location: index.php?admin&action=AdminAjoutActualite');
            exit();
        }
    } else {
        $_SESSION['error-message'] = "Type non autorisé !";
        header('location: index.php?admin&action=AdminAjoutActualite');
        exit();
    }
}

$nom_image = $_FILES['picture_post']['name'];

if (isset($_POST['submit'])) {
    if (isset($_POST['title_post']) && isset($image) && isset($_POST['date_post']) && isset($_POST['content_post']) && isset($_POST['author_id'])) {
        if (!empty($_POST['title_post']) && !empty($image) && !empty($_POST['date_post']) && !empty($_POST['content_post']) && !empty($_POST['author_id'])) {

            $title = htmlspecialchars(strip_tags(trim($_POST['title_post'])));
            $content = $_POST['content_post'];
            $authorId = htmlspecialchars(strip_tags(trim($_POST['author_id'])));

            // Dates
            $date = htmlspecialchars(strip_tags(trim($_POST['date_post']))); // On récupère
            $dateObj = DateTime::createFromFormat('Y-m-d\TH:i', $date); // On convertit en objet datetime
            // Vérifier si les dates sont valides
            if (!$dateObj) {
                $_SESSION['error-message'] = "Une erreur est survenue";
                header('location: index.php?admin&action=AdminAjoutActualite');
                exit();
            }
            // Formater les dates dans le format DATETIME
            $formattedDate = $dateObj ? $dateObj->format('Y-m-d H:i:s') : null;

            $post = new Post();
            $post->setTitle($title);
            $post->setDate($formattedDate);
            $post->setContent($content);
            $post->setAuthorId($authorId);

            try {
                $postRepository = new PostRepository();
                $postRepository->addPost($post);

                $id = $postRepository->getDb()->lastInsertId();
                $postRepository->updatePostImage($id, $nom_image, $image);

                $_SESSION['success-message'] = "L'article a bien été ajouté !";
                header('location: index.php?admin&action=AdminActualites');
                exit();

            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        } else {
            $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
            header('location: index.php?admin&action=AdminAjoutActualite');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Tous les champs doivent être remplie !";
        header('location: index.php?admin&action=AdminAjoutActualite');
        exit();
    }
}
?>