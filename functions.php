<?php
require 'config.php';

function checklist(array $items, string $type, string $name){
    $list = [];
    foreach ($items as $key => $value) {
        $is_checked = "";
        if (isset($_GET[$name]) && in_array($key, $_GET[$name])) {
            $is_checked = "checked" ;
        }
        $list[] = '<label><input type="'. $type .'" name="'. $name .'[]" value="'. $key .'"  '. $is_checked .' /> '. $key .'</label>';
    }
    return $list;
}

function verify(?array $items, string $element){
    if (empty($items)) {
        return "Veillez choisir au moins un " . $element;
    }
}

function getPrice(array $elements, array $category){
    $price = 0;
        foreach ($elements as $value) {
        $price += $category[$value];
    }
    return $price;
}

function creneauxHtml(array $creneaux)
{
    $k = 0;
    if (!empty($creneaux)) {
        foreach ($creneaux as $creneau_par_jour) {
            $new_creneaux = [];
            $active_day =  $k+1 === (int)date('N') ? "text-danger" : "";
            if (!empty($creneau_par_jour)) {
                foreach ($creneau_par_jour as $key => $creneau) {
                    $new_creneaux[$key] = $creneau[0] . "h a " . $creneau[1] . "h";
                }
                $phrases[] = "<li class=".$active_day."><h5>" . JOURS[$k] . " :</h5>" . implode(' et de ', $new_creneaux) . "</li>";
            } else {
                $phrases[] = "<li class=\"$active_day\"><h5>" . JOURS[$k] . " :</h5> Fermer </li>";
            }
            $k++;
        }
        return $phrases;
    }
    return "Horaire non definies !";
}

function in_creneaux(int $heure, array $creneaux): bool{
    foreach ($creneaux as $key => $value) {
        if($heure >= $value[0] && $value[1] > $heure){
            return true;
        }
    }
    return false;
}

function create_compteur_file($file)
{
    try {
        file_put_contents($file, "1", FILE_APPEND);
        return true;
    } catch (\Exception $th) {
        return false;
    }
}

function getNbrVist(): int
{
    return (int)file_get_contents(FILE);
}

function compteur(): void
{
    if (file_exists(FILE)) {
        increment(FILE);
        increment(FILEPERDAY);
    } else {
        create_compteur_file(FILE);
        create_compteur_file(FILEPERDAY);
    }
}

function increment($fichier): void
{
    $nbr_vue = @file_get_contents($fichier);
    $nbr_vue++;
    file_put_contents($fichier, $nbr_vue);
}

function getNbrVisitPerMonth(int $year, int $month):array{
    $total = 0;
    $month = str_pad($month, 2, 0, STR_PAD_LEFT);
    $path = __DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "compteur_". $year . "-" . $month . "-*";
    $files = glob($path);
    foreach($files as $file){
        $details[] = [
            'jour' => (explode("-",pathinfo($file)['filename']))[2],
            'vue' => file_get_contents($file)
        ];
        $total = $total + (int)file_get_contents($file);
    }
    return [
        'details' => $details ?? null,
        'total' => $total
    ];
 }