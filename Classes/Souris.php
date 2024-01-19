<?php

namespace Classes;

class Souris extends MaterielInformatique
{
    private $type = 'souris';

    public function __construct($nom, $prix, $lien, $stock) {
        parent::__construct($nom, $this->type, $prix, $lien, $stock);
    }
}
?>
