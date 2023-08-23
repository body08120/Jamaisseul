<?php
require_once('helpers/autoloader.php');

/**
 * UserRepository - Gère les interactions avec la table "users" de la base de données.
 */
class UserRepository extends Connect
{
    /**
     * Constructeur de la classe UserRepository.
     * Fais appel au constructeur de la base de données
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Nettoie les entrées utilisateur pour éviter les attaques par injection SQL.
     *
     * @param string $input Donnée à nettoyer
     * @return string Donnée nettoyée
     */
    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    /**
     * Récupère un utilisateur en fonction de son adresse e-mail et de son nom d'utilisateur.
     *
     * @param string $email Adresse e-mail de l'utilisateur
     * @param string $username Nom d'utilisateur de l'utilisateur
     * @return User|array|null Instance de la classe User ou un tableau vide s'il n'existe pas d'utilisateur correspondant
     */
    public function getUserByEmailAndUsername($email, $username)
    {
        $safeMail = $this->sanitizeInput($email);
        $safeName = $this->sanitizeInput($username);
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE email = ? AND username = ?');
        $req->execute([$safeMail, $safeName]);
        $data = $req->fetch();

        if ($data != false) {
        
            $user = new User($data['username'], $data['email'], $data['password'], $data['picture_user'], $data['desc_picture_user']);
            $user->setIdUser($data['id_user']);

            return $user;
        } else {

            return [];
        }
    }

    /**
     * Récupère l'ID d'un utilisateur en fonction de son adresse e-mail.
     *
     * @param string $email Adresse e-mail de l'utilisateur
     * @return int|null ID de l'utilisateur ou null s'il n'existe pas
     */
    public function getUserIdByEmail(string $email)
    {
        $safeMail = $this->sanitizeInput($email);
        $sql = "SELECT id_user FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':email', $safeMail);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['id_user'])) {
            return $result['id_user'];
        }

        return null;
    }

    public function getUserByUsername($username)
    {
        $req = $this->getDb()->prepare('SELECT * FROM users WHERE username = ?');
        $req->execute([$username]);
        $data = $req->fetch();
        if ($data != false) {
            $user = new User($data['username'], $data['email'], $data['password'], $data['picture_user'], $data['desc_picture_user']);
            $user->setIdUser($data['id_user']);

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
            $user = new User($data['username'], $data['email'], $data['password'], $data['picture_user'], $data['desc_picture_user']);
            $user->setIdUser($data['id_user']);

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
        }

        return true;
    }

    public function verifyEmailExists($email)
    {
        // Assurons-nous que l'email est sécurisé pour éviter les attaques par injection SQL.
        $safeEmail = $this->sanitizeInput($email);

        // Requête pour vérifier si l'email existe en base de données.
        $query = "SELECT COUNT(*) AS count FROM users WHERE email = :email";
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':email', $safeEmail);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        // Vérification du résultat.
        if ($result['count'] > 0) {
            // L'email existe en base de données.
            // Tu peux également récupérer d'autres informations de l'utilisateur si nécessaire.
            return true;
        } else {
            // L'email n'existe pas en base de données.
            return false;
        }
    }

    public function saveResetToken(string $email, string $token)
    {
        $userId = $this->getUserIdByEmail($email);
        $createdAt = date('Y-m-d H:i:s');

        $sql = "INSERT INTO password_reset_token (created_at, token, id_user) VALUES (:created_at, :token, :id_user)";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':id_user', $userId);
        $stmt->bindValue(':token', $token);
        $stmt->bindValue(':created_at', $createdAt);
        $stmt->execute();
    }

    public function verifyTokenResetPasswordExist($token)
    {
        $sql = "SELECT `token` FROM `password_reset_token` WHERE `token` = :token";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $data = $stmt->fetch();

        if ($data) {

            return true;
        } else {

            return false;
        }

    }

    public function verifyTokenResetPasswordExpired($token)
    {
        $createdDateTime = $this->getCreatedDateTimeFromDatabase($token);
        if ($createdDateTime === false) {

            return false;
        }

        $currentTimestamp = time();
        $createdTimestamp = strtotime($createdDateTime);

        $timeElapsed = $currentTimestamp - $createdTimestamp;

        if ($timeElapsed > 30 * 60) {

            return false;
        }

        return true;
    }

    private function getCreatedDateTimeFromDatabase($token)
    {
        $sql = "SELECT created_at FROM password_reset_token WHERE token = :token";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['created_at'])) {

            return $result['created_at'];
        } else {

            return false;
        }
    }

    public function deleteTokenFromDatabase($token)
    {
        $sql = "DELETE FROM password_reset_token WHERE token = :token";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
    }

    public function findUserByToken($token)
    {
        $sql = "SELECT id_user FROM password_reset_token WHERE token = :token";
        $stmt = $this->getDb()->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $userId = $stmt->fetch(PDO::FETCH_ASSOC);

        return $userId;
    }
}
?>