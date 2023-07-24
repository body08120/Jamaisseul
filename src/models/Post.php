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