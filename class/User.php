<?php
require_once('Connect.php');

class User
{
    private int $id_user;

    private string $username;

    private string $email;

    private string $password;

    private string $picture;

    private string $descPicture;

    public function __construct()
    {
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
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
        return $this->descPicture;
    }

    public function setDescPicture($descPicture)
    {
        $this->descPicture = $descPicture;
    }
}

class UserRepository extends Connect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserByEmailAndUsername($email, $username)
    {
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE email = ? AND username = ?');
        $req->execute([$email, $username]);
        $data = $req->fetch();
        if ($data != false) {
            $user = new User();
            $user->setIdUser($data['id_user']);
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setPicture($data['picture_user']);

            return $user;
        } else {

            return [];
        }
    }

    public function getUserByUsername($username)
    {
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute([$username]);
        $data = $req->fetch();
        if ($data != false) {
            $user = new User();
            $user->setIdUser($data['id_user']);
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            $user->setPicture($data['picture_user']);

            return $user;
        } else {

            return [];
        }
    }

    public function updateUserPicture($username, $imageName, $imagePath)
    {
        $sql = "UPDATE users SET desc_picture_user = ?, picture_user = ? WHERE username = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$imageName, $imagePath, $username]);
        $stmt->closeCursor();
    }

    private function deleteUsername($idUser)
    {
        $sql = "UPDATE users SET username = '' WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idUser]);
        $stmt->closeCursor();
    }

    public function updateUsername($idUser, $newUsername)
    {
        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deleteUsername($idUser);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE users SET username = ? WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newUsername, $idUser]);
        $stmt->closeCursor();
    }

    private function deleteEmail($idUser)
    {
        $sql = "UPDATE users SET email = '' WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idUser]);
        $stmt->closeCursor();
    }

    public function updateEmail($idUser, $newEmail)
    {
        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deleteEmail($idUser);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE users SET email = ? WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$newEmail, $idUser]);
        $stmt->closeCursor();
    }

    private function deletePassword($idUser)
    {
        $sql = "UPDATE users SET password = '' WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$idUser]);
        $stmt->closeCursor();
    }

    public function updatePassword($idUser, $newPassword)
    {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Supprimer l'ancien titre associé à l'ID correspondant
        $this->deletePassword($idUser);

        // Mettre à jour le titre avec le nouvel ID correspondant
        $sql = "UPDATE users SET password = ? WHERE id_user = ?";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->execute([$hashedPassword, $idUser]);
        $stmt->closeCursor();
    }
}

?>