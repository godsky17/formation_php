<?php
namespace App;

class Creneau{

    public $fin;
    public $debut;

    public function __construct(int $debut, int $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public function inclusHeure(int $heure): bool
    {
        return ($this->debut <= $heure && $this->fin >= $heure);
    }

    public function toHTML(): string
    {
        return "<strong>{$this->debut}</strong> a <strong>{$this->fin}</strong>";
    }
}