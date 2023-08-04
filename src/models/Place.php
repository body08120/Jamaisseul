<?php
require_once('helpers/autoloader.php');

class Place
{
    private $idPlace;

    private $namePlace;

    private $inseePlace;

    public function __construct($id, $name, $insee)
    {
        $this->idPlace = $id;
        $this->namePlace = $name;
        $this->inseePlace = $insee;
    }

    public function getIdPlace()
    {
        return $this->idPlace;
    }

    public function getNamePlace()
    {
        return $this->namePlace;
    }

    public function getInseePlace()
    {
        return $this->inseePlace;
    }

    public function setIdPlace($idPlace)
    {
        $this->idPlace = $idPlace;
    }

    public function setNamePlace($namePlace)
    {
        $this->namePlace = $namePlace;
    }

    public function setInseePlace($inseePlace)
    {
        $this->inseePlace = $inseePlace;
    }
}