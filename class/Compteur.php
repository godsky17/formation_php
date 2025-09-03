<?php 
namespace App;

class Compteur
{
    /**@var string $compteur_file_path */
    protected $compteur_file_path;

    /**
     * @param string $path chemin vers le fichier qui enregistre le nombre de chargement global des fichiers du site web
     * @return void
     */
    public function __construct(string $path)
    {
        $this->compteur_file_path = $path;
    }

    /**
     * Modifie la valeur dans le fichier de comptage
     * @var int $nbr_vue Valeur dans le fichier de comptage
     * @return void
     */
    public function incrementer(): void
    {
        $nbr_vue = (int)file_get_contents($this->compteur_file_path);
        $nbr_vue++;
        file_put_contents($this->compteur_file_path, $nbr_vue);
    }

    /**
     * Retourne le nombre de fois les pages du site on ete chargees
     * @return int
     */
    public function recuperer()
    {
        return (int)file_get_contents($this->compteur_file_path);
    }
}