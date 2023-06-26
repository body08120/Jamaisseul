<?php
require_once('Connect.php');

class Post
{
    private $id_post;

    private $title_post;

    private $desc_post;

    private $date_post;

    private $picture_post;

    private $desc_picture_post;

    private $content_post;

    private $text_post;

    private $outro_post;

    private $author_post;

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

    public function getDescPost()
    {
        return $this->desc_post;
    }

    public function setDescPost($desc_post)
    {
        $this->desc_post = $desc_post;
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

    public function getText()
    {
        return $this->text_post;
    }

    public function setText($text_post)
    {
        $this->text_post = $text_post;
    }

    public function getOutro()
    {
        return $this->outro_post;
    }

    public function setOutro($outro_post)
    {
        $this->outro_post = $outro_post;
    }

    public function getAuthor()
    {
        return $this->author_post;
    }

    public function setAuthor($author_post)
    {
        $this->author_post = $author_post;
    }
}

class PostRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function last_id()
    // {
    //     $req = $this->getDb()->prepare("SELECT MAX(id) FROM posts");
    //     $req->execute();
    //     $data = $req->fetchAll();
    //     $req->closeCursor();
    //     return $data;
    // }

    // public function last_id()
    // {
    //     $req = $this->getDb()->prepare("SELECT MAX(id) AS max_id FROM posts");
    //     $req->execute();
    //     $data = $req->fetch();
    //     $req->closeCursor();

    //     $lastId = $data['max_id'];

    //     // Crée un objet contenant le dernier ID
    //     $lastIdObject = new stdClass();
    //     $lastIdObject->lastId = $lastId;

    //     return $lastIdObject;
    // }

    public function getTotalPostsCount()
    {
        $sql = "SELECT COUNT(*) FROM posts";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn(); // Utilisez fetchColumn() au lieu de fetch()

        if ($result !== false) {
            return $result;
        } else {
            return 0;
        }
    }


    public function updatePostImage($postId, $imageName, $imagePath)
    {
        $sql = "UPDATE posts SET desc_picture_post = ?, picture_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imageName, $imagePath, $postId]);
        $stmt->closeCursor();
    }

    public function findAllPosts($limit, $offset)
    {
        $sql = "SELECT * FROM posts ORDER BY id_post DESC LIMIT ? OFFSET ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {
            // articles trouvés
            // Boucle sur les données
            $posts = [];
            foreach ($datas as $data) {
                $post = new Post();
                $post->setId($data['id_post']);
                $post->setTitle($data['title_post']);
                $post->setDescPost($data['desc_post']);
                $post->setDate($data['date_post']);
                $post->setPicture($data['picture_post']);
                $post->setDescPicture($data['desc_picture_post']);
                $post->setContent($data['content_post']);
                $post->setText($data['text_post']);
                $post->setOutro($data['outro_post']);
                $post->setAuthor($data['author_post']);

                $posts[] = $post;
            }
            return $posts;
        } else {
            return [];
        }
    }

    public function findPostById($id_post)
    {
        $sql = "SELECT * FROM posts WHERE id_post = :id";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':id', $id_post);
        $stmt->execute();
        $articleData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($articleData !== false) {
            $post = new Post();
            $post->setId($articleData['id_post']);
            $post->setTitle($articleData['title_post']);
            $post->setDescPost($articleData['desc_post']);
            $post->setDate($articleData['date_post']);
            $post->setPicture($articleData['picture_post']);
            $post->setDescPicture($articleData['desc_picture_post']);
            $post->setContent($articleData['content_post']);
            $post->setText($articleData['text_post']);
            $post->setOutro($articleData['outro_post']);
            $post->setAuthor($articleData['author_post']);

            return $post;
        } else {
            return null;
        }
    }

    public function addPost(Post $post)
    {
        $sql = "INSERT INTO posts (title_post, desc_post, date_post, picture_post, desc_picture_post, content_post, text_post, outro_post, author_post) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([
            $post->getTitle(),
            $post->getDescPost(),
            $post->getDate(),
            '',
            $post->getDescPicture(),
            $post->getContent(),
            $post->getText(),
            $post->getOutro(),
            $post->getAuthor()
        ]);

    }

    public function deletePost($postId)
    {
        $sql = "DELETE FROM posts WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$postId]);

        // ... logique supplémentaire si nécessaire ...
    }

    public function updatePost(Post $post) {
        $id = $post->getId();
        $title = $post->getTitle();
        $desc = $post->getDescPost();
        $date = $post->getDate();
        $content = $post->getContent();
        $text = $post->getText();
        $outro = $post->getOutro();
        $author = $post->getAuthor();

        $this->updateTitle($id, $title);
        $this->updateDate($id, $date);
        $this->updateDescPost($id, $desc);
        $this->updateContent($id, $content);
        $this->updateText($id, $text);
        $this->updateOutro($id, $outro);
        $this->updateAuthor($id, $author);
    }

    private function deleteTitle($idPost)
    {
        $sql = "UPDATE posts SET title_post = '' WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateTitle($idPost, $newTitle)
    {
        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deleteTitle($idPost);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE posts SET title_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newTitle, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteDescPost($idPost)
    {
        $sql = "UPDATE posts SET desc_post = '' WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateDescPost($idPost, $newDescPost)
    {
        // Supprimer l'ancien desc_post associé à l'ID correspondant
        $this->deleteDescPost($idPost);

        // Mettre à jour le desc_post avec le nouvel ID correspondant
        $sql = "UPDATE posts SET desc_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newDescPost, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteDate($idPost)
    {
        $sql = "UPDATE posts SET date_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateDate($idPost, $newDate)
    {
        // Supprimer l'ancienne date associée à l'ID correspondant
        $this->deleteDate($idPost);

        // Mettre à jour la date avec le nouvel ID correspondant
        $sql = "UPDATE posts SET date_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newDate, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteContent($idPost)
    {
        $sql = "UPDATE posts SET content_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateContent($idPost, $newContent)
    {
        // Supprimer l'ancien contenu associé à l'ID correspondant
        $this->deleteContent($idPost);

        // Mettre à jour le contenu avec le nouvel ID correspondant
        $sql = "UPDATE posts SET content_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newContent, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteText($idPost)
    {
        $sql = "UPDATE posts SET text_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateText($idPost, $newText)
    {
        // Supprimer l'ancien texte associé à l'ID correspondant
        $this->deleteText($idPost);

        // Mettre à jour le texte avec le nouvel ID correspondant
        $sql = "UPDATE posts SET text_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newText, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteOutro($idPost)
    {
        $sql = "UPDATE posts SET outro_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateOutro($idPost, $newOutro)
    {
        // Supprimer l'ancien outro associé à l'ID correspondant
        $this->deleteOutro($idPost);

        // Mettre à jour l'outro avec le nouvel ID correspondant
        $sql = "UPDATE posts SET outro_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newOutro, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteAuthor($idPost)
    {
        $sql = "UPDATE posts SET author_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateAuthor($idPost, $newAuthor)
    {
        // Supprimer l'ancien auteur associé à l'ID correspondant
        $this->deleteAuthor($idPost);

        // Mettre à jour l'auteur avec le nouvel ID correspondant
        $sql = "UPDATE posts SET author_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newAuthor, $idPost]);
        $stmt->closeCursor();
    }

}


?>