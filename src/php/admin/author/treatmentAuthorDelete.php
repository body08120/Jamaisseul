<?php
// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur
    if (isset($_POST['deleteAuthorId'])) {
        $authorId = $_POST['deleteAuthorId'];
        try {
            $authorRepository = new AuthorRepository();
            $image = $authorRepository->getAuthorById($authorId);
            $imagePath = $image->getPicture();

            $path = $imagePath;

            if (!unlink($path)) {
                $_SESSION['error-message'] = "L'image n'a pas été supprimée : $path";
                header('Location: index.php?admin&action=AdminAuteurs');
                exit;
            }
            $authorRepository->deleteAuthor($authorId);

            $_SESSION['success-message'] = "L'auteur a bien été supprimée";
            header('Location: index.php?admin&action=AdminAuteurs');

        } catch (Exception $e) {
            $_SESSION['error-message'] = "L'auteur n'a pas été supprimée";
            header('Location: index.php?admin&action=AdminAuteurs');
            exit();
        }

    } else {
        $_SESSION['error-message'] = "Une erreur est survenue dans la sélection des auteurs";
        header('Location: index.php?admin&action=AdminAuteurs');
        exit();
    }

} else {
    $_SESSION['error-message'] = "Une erreur est survenue dans le traitement des données";
    exit();
}

 ?>