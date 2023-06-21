<?php
require_once('Connect.php');

class Post
{
    private $id;

    private $title;

    private $desc_post;

    private $date;

    private $picture;

    private $desc_picture;

    public function __construct()
    {
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
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
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
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

    public function setDescPicture($desc_picture)
    {
        $this->desc_picture = $desc_picture;
    }
}

class PostRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function last_id()
    {
        $req = $this->getDb()->prepare("SELECT MAX(id) FROM posts");
        $req->execute();
        $data = $req->fetchAll();
        $req->closeCursor();
        return $data;
    }

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
        $sql = "UPDATE posts SET desc_picture = ?, picture = ? WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imageName, $imagePath, $postId]);
        $stmt->closeCursor();
    }

    public function findAllPosts($limit, $offset)
    {
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT ? OFFSET ?";
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
                $post->setId($data['id']);
                $post->setTitle($data['title']);
                $post->setDescPost($data['desc_post']);
                $post->setDate($data['date']);
                $post->setPicture($data['picture']);
                $post->setDescPicture($data['desc_picture']);

                $posts[] = $post;
            }
            return $posts;
        } else {
            return [];
        }
    }

    public function findPostById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $articleData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($articleData !== false) {
            $post = new Post();
            $post->setId($articleData['id']);
            $post->setTitle($articleData['title']);
            $post->setDescPost($articleData['desc_post']);
            $post->setDate($articleData['date']);
            $post->setPicture($articleData['picture']);
            $post->setDescPicture($articleData['desc_picture']);

            return $post;
        } else {
            return null;
        }
    }

    public function addPost(Post $post)
    {
        $sql = "INSERT INTO posts (title, desc_post, date, picture, desc_picture) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([
            $post->getTitle(),
            $post->getDescPost(),
            $post->getDate(),
            '',
            $post->getDescPicture()
        ]);

        // ... logique supplémentaire si nécessaire ...
    }

    public function deletePost($postId)
    {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$postId]);

        // ... logique supplémentaire si nécessaire ...
    }

    public function updateTitle($idPost, $newTitle)
    {
        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deleteTitle($idPost);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE posts SET title = ? WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newTitle, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteTitle($idPost)
    {
        $sql = "UPDATE posts SET title = '' WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateDescPost($idPost, $newDescPost)
    {
        // Supprimer l'ancien desc_post associé à l'ID correspondant
        $this->deleteDescPost($idPost);

        // Mettre à jour le desc_post avec le nouvel ID correspondant
        $sql = "UPDATE posts SET desc_post = ? WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newDescPost, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteDescPost($idPost)
    {
        $sql = "UPDATE posts SET desc_post = '' WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateDate($idPost, $newDate)
    {
        // Supprimer l'ancienne date associée à l'ID correspondant
        $this->deleteDate($idPost);

        // Mettre à jour la date avec le nouvel ID correspondant
        $sql = "UPDATE posts SET date = ? WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newDate, $idPost]);
        $stmt->closeCursor();
    }

    private function deleteDate($idPost)
    {
        $sql = "UPDATE posts SET date = NULL WHERE id = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

}


?>