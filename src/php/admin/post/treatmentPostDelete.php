<?php
// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deletePostId"
    if (isset($_POST['deletePostId'])) {
        $postId = $_POST['deletePostId'];
        try {
            $postRepository = new PostRepository();
            $image = $postRepository->findPostById($postId);
            $imagePath = $image->getPicture();

            $path = $imagePath;

            if (!unlink($path)) {
                $_SESSION['error-message'] = "L'image n'a pas été supprimée : $path";
                header('Location: index.php?admin&action=AdminActualites');
                exit;
            }
            $postRepository->deletePost($postId);

            $_SESSION['success-message'] = "L'article a bien été supprimé";
            header('Location: index.php?admin&action=AdminActualites');

        } catch (Exception $e) {
            $_SESSION['error-message'] = "L'article n'a pas été supprimé";
            header('Location: index.php?admin&action=AdminActualites');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Une erreur est survenue dans la sélection des articles";
        header('Location: index.php?admin&action=AdminActualites');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue dans le traitement des données";
    exit();
}

?>