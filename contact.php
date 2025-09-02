<?php 
    $page_title = "Contact";
    require_once "functions.php";
    require_once "config.php";
    date_default_timezone_set('Africa/Porto-Novo');
    $creneaux = creneauxHtml(CRENEAUX);
    $heure = (int)date('G');
    $creneau_today = CRENEAUX[date('N') - 1];
    $ouvert = in_creneaux($heure, $creneau_today);
    $ouvert_form = null;
    //  Traitement formulaire
    if(isset($_GET['heure']) && isset($_GET['date'])){
        $heure = !empty($_GET['heure']) ? (int)date('G', strtotime($_GET['heure'])) : null;
        $date = !empty($_GET['date']) ? (int)date('N', strtotime($_GET['date'])) - 1 : null;
        if ($date != null && $heure != null) {
            $ouvert_form = in_creneaux($heure, CRENEAUX[$date]);
        }
    }
    require "header.php" 
?>

<main class="container">
    <div class="bg-light p-5 d-flex flex-row justify-contents-between rounded">
        <div class="col-md-8 pe-2">
            <h1>Contact-Us</h1>
            <?php if($ouvert_form != null && $ouvert_form):?>
            <div class="alert alert-success">
                <p>Le magazin est ouvert</p>
            </div>
            <?php elseif($ouvert_form != null && !$ouvert_form):?>
            <div class="alert alert-danger">
                <p>Le magazin est ferme</p>
            </div>
            <?php endif ?>
            <form action="./contact.php" method="get">
                <div class="mb-3">
                    <label for="formDate" class="form-label">Date</label>
                    <input type="date" class="form-control" id="formDate" name="date" value="<?= $date ?>">
                </div>

                <div class="mb-3">
                    <label for="formHeure" class="form-label">Date</label>
                    <input type="time" class="form-control" id="formHeure" name="heure" value="<?= date('H:m')?>">
                </div>
                <button type="submit" class="btn btn-primary mt-4">Verifier</button>
            </form>
        </div>
        <div class="col-md-4 pl-2">
            <h1>Heures d'ouverture</h1>
            <?php if($ouvert):?>
            <div class="alert alert-success">
                <p>Le magazin est ouvert</p>
            </div>
            <?php else:?>
            <div class="alert alert-danger">
                <p>Le magazin est ferme</p>
            </div>
            <?php endif ?>
            <?php if(!is_array($creneaux)):?>
                <?= "<h3>" . $creneaux . "</h3?" ?>
            <?php else:?>
                <ul>
                    <?php foreach($creneaux as $creneau):?>
                    <?= $creneau ."<br>" ?>
                    <?php endforeach;?>
                </ul>
            <?php endif;?>
        </div>
    </div>
</main>

<?php require "footer.php" ?>

