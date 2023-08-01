<?php
require_once('helpers/autoloader.php');

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
?>