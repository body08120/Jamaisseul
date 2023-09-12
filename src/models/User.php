<?php
require_once('helpers/autoloader.php');

/**
 * La classe User représente l'administrateur du site.
 */
class User
{
    /** @var int L'identifiant de l'utilisateur. */
    private int $id_user;

    /** @var string Le nom d'utilisateur. */
    private string $username;

    /** @var string L'adresse e-mail de l'utilisateur. */
    private string $email;

    /** mot de passe de l'utilisateur. */
    private  $password;

    /** @var string Le chemin vers l'image de profil de l'utilisateur. */
    private string $picture;

    /** @var string La description de l'image de profil de l'utilisateur. */
    private string $descPicture;

    /**
     * Constructeur de la classe User.
     *
     * @param string $username Le nom d'utilisateur.
     * @param string $email L'adresse e-mail de l'utilisateur.
     * @param string $password Le mot de passe de l'utilisateur.
     * @param $picture Le chemin vers l'image de profil de l'utilisateur.
     * @param string $descPicture La description de l'image de profil de l'utilisateur.
     */
    public function __construct($username, $email, $password, $picture, $descPicture)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->picture = $picture;
        $this->descPicture = $descPicture;
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
?>