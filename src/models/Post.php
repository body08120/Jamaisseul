<?php
require_once('helpers/autoloader.php');

class Post
{
    private $id_post;

    private $title_post;

    private $date_post;

    private $picture_post;

    private $desc_picture_post;

    private $content_post;

    private $author_id;

    public function __construct()
    {
    }


    public function getId()
    {
        return $this->id_post;
    }

    public function setId($id_post)
    {
        $this->id_post = $id_post;
    }

    public function getTitle()
    {
        return $this->title_post;
    }

    public function setTitle($title_post)
    {
        $this->title_post = $title_post;
    }

    public function getDate()
    {
        return $this->date_post;
    }

    public function getFormattedDate()
    {
        // Récupère la date sous forme de chaîne de caractères depuis l'attribut date_post de l'objet
        $dateString = $this->date_post;

        // Crée un objet DateTime à partir de la chaîne de caractères de la date
        $postDate = new DateTime($dateString);

        // Crée un objet DateTime pour la date et l'heure actuelles
        $currentDate = new DateTime();

        // Calculer la différence entre la date actuelle et la date du post
        $interval = $currentDate->diff($postDate);

        // Vérifie s'il s'est écoulé plus d'un an
        if ($interval->y > 0) {
            $formattedDate = "Il y a " . $interval->y . " an" . ($interval->y > 1 ? "s" : "");
        }
        // Vérifie s'il s'est écoulé plus d'un mois
        elseif ($interval->m > 0) {
            $formattedDate = "Il y a " . $interval->m . " mois";
        }
        // Vérifie s'il s'est écoulé plus d'un jour
        elseif ($interval->d > 0) {
            $formattedDate = "Il y a " . $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
        }
        // Vérifie s'il s'est écoulé plus d'une heure
        elseif ($interval->h > 0) {
            $formattedDate = "Il y a " . $interval->h . " heure" . ($interval->h > 1 ? "s" : "");
        }
        // Vérifie s'il s'est écoulé plus d'une minute
        elseif ($interval->i > 0) {
            $formattedDate = "Il y a " . $interval->i . " minute" . ($interval->i > 1 ? "s" : "");
        }
        // Si le temps écoulé est inférieur à une minute
        else {
            $formattedDate = "Il y a quelques secondes";
        }

        // Retourne la date formatée
        return $formattedDate;
    }


    public function setDate($date_post)
    {
        $this->date_post = $date_post;
    }

    public function getPicture()
    {
        return $this->picture_post;
    }

    public function setPicture($picture_post)
    {
        $this->picture_post = $picture_post;
    }

    public function getDescPicture()
    {
        return $this->desc_picture_post;
    }

    public function setDescPicture($desc_picture_post)
    {
        $this->desc_picture_post = $desc_picture_post;
    }

    public function getContent()
    {
        return $this->content_post;
    }

    public function setContent($content_post)
    {
        $this->content_post = $content_post;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }
}
?>