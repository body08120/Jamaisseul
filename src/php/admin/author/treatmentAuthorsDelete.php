<?php
// Vérification si la requête est une méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification de la présence et récupération de la valeur de "deleteJobIds"
    if (isset($_POST['deleteAuthorIds'])) {

        $authorIds = explode('-', $_POST['deleteAuthorIds']);

        try {

            foreach ($authorIds as $authorId) {
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
            }

            $_SESSION['success-message'] = "Les auteurs ont été supprimées avec succès";
            header('Location: index.php?admin&action=AdminAuteurs');
        } catch (Exception $e) {
            $_SESSION['error-message'] = "Les auteurs n'ont pas été supprimées";
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
    header('Location: index.php?admin&action=AdminAuteurs');
    exit();
}
?>