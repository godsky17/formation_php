<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . "Compteur.php";
class DoubleCompteur extends Compteur
{
    public function recuperer()
    {
        return 2*parent::recuperer();
    }
}