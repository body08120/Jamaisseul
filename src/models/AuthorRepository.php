<?php
require_once('helpers/autoloader.php');

class AuthorRepository extends Connect
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllAuthor()
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
                $author->setPicture($data['picture']);
                $author->setDescPicture($data['desc_picture']);
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
            $author->setPicture($datas['picture']);
            $author->setDescPicture($datas['desc_picture']);
            $author->setFacebook($datas['facebook']);
            $author->setTwitter($datas['twitter']);
            $author->setPinterest($datas['pinterest']);
            $author->setDesc($datas['desc_author']);

            return $author;

        } else {

            return [];
        }

    }

    public function getNameAuthorById($id)
    {
        $sql = "SELECT name_author FROM Author WHERE id_author = :id";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $datas = $stmt->fetch();
        if ($datas !== []) {

            $author = new Author();
            $author->setName($datas['name_author']);

            return $author;

        } else {

            return [];
        }

    }

    public function addAuthor(Author $author)
    {
        $sql = "INSERT INTO author (name_author, picture, desc_picture, facebook, twitter, pinterest, desc_author) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([
            $author->getName(),
            $author->getPicture(),
            $author->getDescPicture(),
            $author->getFacebook(),
            $author->getTwitter(),
            $author->getPinterest(),
            $author->getDesc()
        ]);
    }

    public function updateAuthor(Author $author)
    {
        try {
            $sql = "UPDATE author
                    SET name_author = :nameAuthor, facebook = :facebook, twitter = :twitter, pinterest = :pinterest, desc_author = :descAuthor
                    WHERE id_author = :idAuthor";

            $stmt = $this->getDb()->prepare($sql);
            $stmt->bindValue(':nameAuthor', $author->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':facebook', $author->getFacebook(), PDO::PARAM_STR);
            $stmt->bindValue(':twitter', $author->getTwitter(), PDO::PARAM_STR);
            $stmt->bindValue(':pinterest', $author->getPinterest(), PDO::PARAM_STR);
            $stmt->bindValue(':descAuthor', $author->getDesc(), PDO::PARAM_STR);
            $stmt->bindValue(':idAuthor', $author->getId(), PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {

            return false;
        }
    }

    public function updateAuthorImage($authorId, $imageName, $imagePath)
    {
        $sql = "UPDATE author SET picture = ?, desc_picture = ? WHERE id_author = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imagePath, $imageName, $authorId]);
        $stmt->closeCursor();
    }

    public function deleteAuthor($authorId)
    {
        $sql = "DELETE FROM author WHERE id_author = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$authorId]);
    }
}
?>