<?php

namespace Classes;

class MaterielInformatique 
{
    private $nom;
    private $type;
    private $prix;
    private $lien;
    private $stock;

    public function __construct($nom, $type, $prix, $lien, $stock) {
        $this->nom = $nom;
        $this->type = $type;
        $this->prix = $prix;
        $this->lien = $lien;
        $this->stock = $stock;
    }

    public function insererDonnees() {
        $sql = "INSERT INTO ". Connexion::$table ." (nom, type, prix, lien, stock) VALUES (?, ?, ?, ?, ?)";
        Connexion::executerRequete($sql, [$this->nom, $this->type, $this->prix, $this->lien, $this->stock]);
    }
}

?>
