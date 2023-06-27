<?php
require_once('Connect.php');

class User
{
    private $id_user;

    private $username;

    private $email;

    private $password;

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

            return $user;
        } else {

            return [];
        }
    }
}

?>