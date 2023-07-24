<?php
require_once('helpers/autoloader.php');

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
?>