<?php
require_once('Connect.php');

class Author
{

    private $id_author;

    private $name_author;

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

class AuthorRepository extends Connect
{

    public function __construct()
    {
        parent::__construct();
    }

    public function GetAllAuthor()
    {
        $sql = "SELECT * FROM author ORDER BY id_author DESC";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {
            // Auteur trouvés
            // Boucle sur les données
            $authors = [];
            foreach ($datas as $data) {
                $author = new Author();
                $author->setId($data['id_author']);
                $author->setName($data['name_author']);
                $author->setFacebook($data['facebook']);
                $author->setTwitter($data['twitter']);
                $author->setPinterest($data['pinterest']);
                $author->setDesc($data['desc_author']);

                $authors[] = $author;
            }

            return $authors;

        } else {
            return [];
        }
    }

    public function getAuthorById($id)
    {
        $sql = "SELECT * FROM Author WHERE id_author = :id";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $datas = $stmt->fetch();
        if ($datas !== []) {

            $author = new Author();
            $author->setId($datas['id_author']);
            $author->setName($datas['name_author']);
            $author->setFacebook($datas['facebook']);
            $author->setTwitter($datas['twitter']);
            $author->setPinterest($datas['pinterest']);
            $author->setDesc($datas['desc_author']);

            return $author;

        } else {

            return [];
        }

    }
}