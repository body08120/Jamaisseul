<?php
require_once('helpers/autoloader.php');

class Author
{

    private $id_author;

    private $name_author;

    private $picture;

    private $desc_picture;

    private $facebook;

    private $twitter;

    private $pinterest;

    private $desc_author;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id_author;
    }

    public function setId($id)
    {
        $this->id_author = $id;
    }

    public function getName()
    {
        return $this->name_author;
    }

    public function setName($name)
    {
        $this->name_author = $name;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    public function getDescPicture()
    {
        return $this->desc_picture;
    }

    public function setDescPicture($descPicture)
    {
        $this->desc_picture = $descPicture;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;
    }

    public function getPinterest()
    {
        return $this->pinterest;
    }

    public function setPinterest($pinterest)
    {
        $this->pinterest = $pinterest;
    }

    public function getDesc()
    {
        return $this->desc_author;
    }

    public function setDesc($desc_author)
    {
        $this->desc_author = $desc_author;
    }
}

?>