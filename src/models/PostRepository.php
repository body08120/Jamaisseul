<?php
require_once('helpers/autoloader.php');
class PostRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLatestPosts()
    {
        $sql = "SELECT * FROM posts 
                ORDER BY id_post DESC
                LIMIT 3";
        $stmt = $this->getDb()->prepare($sql);
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
                $post->setDate($data['date_post']);
                $post->setPicture($data['picture_post']);
                $post->setDescPicture($data['desc_picture_post']);
                $post->setContent($data['content_post']);
                $post->setAuthorId($data['id_author']);

                // On cherche l'auteur
                $authorsRepository = new AuthorRepository();
                $author = $authorsRepository->getNameAuthorById($post->getAuthorId());

                $posts[] = [
                    'post' => $post,
                    'author' => $author
                ];
                // $posts[] = $author;
            }
            return $posts;
        } else {
            return [];
        }
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
        $sql = "UPDATE posts SET desc_picture_post = ?, picture_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imageName, $imagePath, $postId]);
        $stmt->closeCursor();
    }

    public function findAllPosts()
    {
        $sql = "SELECT * FROM posts ORDER BY id_post DESC";
        $stmt = $this->getDb()->prepare($sql);
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
                $post->setDate($data['date_post']);
                $post->setPicture($data['picture_post']);
                $post->setDescPicture($data['desc_picture_post']);
                $post->setContent($data['content_post']);
                $post->setAuthorId($data['id_author']);

                $posts[] = $post;
            }
            return $posts;
        } else {
            return [];
        }
    }

    public function countPosts()
    {
        $sql = "SELECT COUNT(*) AS nb_posts 
        FROM posts";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }
    public function findAllPostsPagined($premier, $parPage)
    {
        $sql = "SELECT * FROM posts 
                ORDER BY id_post DESC
                LIMIT :premier, :parpage";

        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':premier', $premier, PDO::PARAM_INT);
        $stmt->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        $stmt->execute();
        $datas = $stmt->fetchAll();

        if ($datas !== []) {
            $posts = [];
            foreach ($datas as $data) {
                $post = new Post();
                $post->setId($data['id_post']);
                $post->setTitle($data['title_post']);
                $post->setDate($data['date_post']);
                $post->setPicture($data['picture_post']);
                $post->setDescPicture($data['desc_picture_post']);
                $post->setContent($data['content_post']);
                $post->setAuthorId($data['id_author']);

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
            $post->setDate($articleData['date_post']);
            $post->setPicture($articleData['picture_post']);
            $post->setDescPicture($articleData['desc_picture_post']);
            $post->setContent($articleData['content_post']);
            $post->setAuthorId($articleData['id_author']);

            return $post;
        } else {
            return null;
        }
    }

    public function addPost(Post $post)
    {
        $sql = "INSERT INTO posts (title_post, date_post, picture_post, desc_picture_post, content_post, id_author) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([
            $post->getTitle(),
            $post->getDate(),
            '',
            $post->getDescPicture(),
            $post->getContent(),
            $post->getAuthorId()
        ]);

    }

    public function deletePost($postId)
    {
        $sql = "DELETE FROM posts WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$postId]);

        // ... logique supplémentaire si nécessaire ...
    }

    public function updatePostAndPicture(Post $post)
    {
        $id = $post->getId();
        $title = $post->getTitle();
        $date = $post->getDate();
        $picture = $post->getPicture();
        $descPicture = $post->getDescPicture();
        $content = $post->getContent();

        $this->updateTitle($id, $title);
        $this->updateDate($id, $date);
        $this->updatePicture($id, $picture, $descPicture);
        $this->updateContent($id, $content);
    }

    public function updatePost(Post $post)
    {
        $id = $post->getId();
        $title = $post->getTitle();
        $date = $post->getDate();
        $content = $post->getContent();
        $authorId = $post->getAuthorId();

        $this->updateTitle($id, $title);
        $this->updateDate($id, $date);
        $this->updateContent($id, $content);
        $this->updateAuthorId($id, $authorId);
    }

    private function deleteAuthorId($idPost)
    {
        $sql = "UPDATE posts SET id_author = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updateAuthorId($idPost, $newAuthorId)
    {
        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deleteAuthorId($idPost);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE posts SET id_author = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newAuthorId, $idPost]);
        $stmt->closeCursor();
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

    public function deletePicture($idPost)
    {
        $sql = "UPDATE posts SET picture_post = NULL, desc_picture_post = NULL WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idPost]);
        $stmt->closeCursor();
    }

    public function updatePicture($idPost, $newPicture, $newDescPicture)
    {
        // Supprimer l'ancien contenu associé à l'ID correspondant
        $this->deletePicture($idPost);

        // Mettre à jour le contenu avec le nouvel ID correspondant
        $sql = "UPDATE posts SET picture_post = ?, desc_picture_post = ? WHERE id_post = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newPicture, $newDescPicture, $idPost]);
        $stmt->closeCursor();
    }

    public function getPrecPostById($id)
    {
        $sql = "SELECT id_post, picture_post, desc_picture_post FROM posts WHERE id_post < ? ORDER BY id_post DESC LIMIT 1";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        if ($result) {
            $post = new Post();
            $post->setId($result['id_post']);
            $post->setPicture($result['picture_post']);
            $post->setDescPicture($result['desc_picture_post']);

            return $post;
        }

        return false;
    }

    public function getNextPostById($id)
    {
        $sql = "SELECT id_post, picture_post, desc_picture_post FROM posts WHERE id_post > ? ORDER BY id_post ASC LIMIT 1";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        if ($result) {
            $post = new Post();
            $post->setId($result['id_post']);
            $post->setPicture($result['picture_post']);
            $post->setDescPicture($result['desc_picture_post']);

            return $post;
        }

        return false;
    }


}
?>