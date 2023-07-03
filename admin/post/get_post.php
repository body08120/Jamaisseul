<?php
session_start();
if (!isset($_SESSION['username']) && empty($_SESSION['username']))
{
    header('Location: ../../');
}
require_once('../../class/Post.php');

if (isset($_POST['id'])) {
    $articleId = $_POST['id'];

    $postRepository = new PostRepository();
    $articleData = $postRepository->findPostById($articleId);

    // Vérifier si l'article existe
    if ($articleData !== null) {
        // Construisez un tableau avec les données de l'article
        $articleDataArray = array(
            'id_post' => $articleData->getId(),
            'title_post' => $articleData->getTitle(),
            'date_post' => $articleData->getDate(),
            'content_post' => $articleData->getContent(),
        );

        // Convertissez le tableau en JSON
        $articleDataJson = json_encode($articleDataArray);

        // Renvoyez la réponse en tant que JSON
        header('Content-Type: application/json');
        echo $articleDataJson;
    } else {
        // Renvoyer une réponse d'erreur si l'article n'existe pas
        header("HTTP/1.0 404 Not Found");
        echo "Article not found.";
    }
}
?>