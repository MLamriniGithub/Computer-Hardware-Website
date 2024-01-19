<?php

namespace Classes;

class CarteGraphique extends MaterielInformatique
{
    private $type = 'carte graphique';

    public function __construct($nom, $prix, $lien, $stock) {
        parent::__construct($nom, $this->type, $prix, $lien, $stock);
    }
}

?>
