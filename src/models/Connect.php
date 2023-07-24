<?php
require_once("config.php");
class Connect
{
    private $db;

    public function __construct()
    {

        // Configuration de la source de données (DSN)
        $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

        try {
            // Création d'une nouvelle instance de PDO (PHP Data Object)
            // pour établir la connexion à la base de données
            $this->db = new PDO($dsn, DBUSER, DBPASS);

            // Configuration du mode de gestion des erreurs
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Configuration de l'encodage des caractères en UTF-8
            $this->db->exec("SET NAMES utf8");
        } catch (PDOException $e) {
            // En cas d'erreur lors de la connexion à la base de données,
            // une exception est lancée avec un message d'erreur
            throw new Exception("Impossible de se connecter à la base de données : " . $e->getMessage());
        }
    }

    public function getDb()
    {
        // Méthode permettant d'obtenir l'instance de la connexion à la base de données
        return $this->db;
    }

    public function prepare($sql)
    {
        // Méthode permettant de préparer une requête SQL en utilisant l'instance de PDO
        return $this->db->prepare($sql);
    }
}



// Instanciation de la classe Connect pour établir la connexion à la base de données
// $connect = new Connect();

// Exemple d'utilisation : requête préparée avec des paramètres
// $stmt = $connect->prepare("SELECT * FROM ma_table WHERE id = :id");
// $stmt->execute(['id' => 1]);
// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>