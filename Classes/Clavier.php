<?php

namespace Classes;

class Clavier extends MaterielInformatique
{
    private $type = 'clavier';

    public function __construct($nom, $prix, $lien, $stock) {
        parent::__construct($nom, $this->type, $prix, $lien, $stock);
    }
}

?>
