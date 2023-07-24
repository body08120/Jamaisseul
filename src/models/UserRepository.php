<?php
require_once('helpers/autoloader.php');
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

    public function getUserById($id)
    {
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE id_user = ?');
        $req->execute([$id]);
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

            return null;
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

    public function verifyPassword($id, $password)
    {
        // Recherchez l'utilisateur par son ID dans la base de données
        // Supposons que vous avez une méthode findUserById dans votre UserRepository
        $user = $this->getUserById($id);

        if (!$user) {
            throw new Exception("Utilisateur introuvable.");
        }

        // Récupérez le mot de passe haché de l'utilisateur
        $hashedPassword = $user->getPassword();

        // Utilisez password_verify pour vérifier si le mot de passe fourni correspond au mot de passe haché
        if (!password_verify($password, $hashedPassword)) {
            throw new Exception("Mot de passe actuel incorrect.");
        } else {
            
            return true;
        }


        // Si tout est vérifié avec succès, le mot de passe actuel est correct
        // Vous pouvez simplement retourner true ou ne rien retourner car cela signifie que la vérification a réussi.
    }
}
?>