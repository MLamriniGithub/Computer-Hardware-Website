<?php

namespace Classes;

class Connexion
{
    private $serveur = 'localhost';
    private $utilisateur = 'root';
    private $mdp = '';
    private $base = 'materiel_info';
    public static $table = 'materiel';
    private static $conn;
    
    private function __construct() {
        try {
            self::$conn = new \PDO("mysql:host=$this->serveur;dbname=$this->base", $this->utilisateur, $this->mdp);
            self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch(\PDOException $e) {
            throw new \Exception('Erreur de connexion de base de données : '.$e->getMessage());
        }
    }

    public static function getConnexion() {
        if(!self::$conn) {
            new Connexion(); 
        }
        return self::$conn;
    }

    public static function executerRequete($req, $params = []) {
        $conn = self::getConnexion();
        $stmt = $conn->prepare($req);
        $stmt->execute($params);
        return $stmt;
    }
}

?>