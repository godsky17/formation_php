<?php 
    $page_title = "Jeu";
    require "header.php" ;

    $message_success = null;
    $message_warning = null;

    $a_deviner = 145;
    if (isset($_GET['valeur'])) {
        $valeur_user = htmlspecialchars($_GET['valeur']);
        if ($valeur_user > $a_deviner) {
            $message_warning = "Ce nombre est plus grand que la valeur a deviner";
        }elseif ($valeur_user < $a_deviner) {
            $message_warning = "Ce nombre est plus petit que la valeur a deviner";
        }elseif($valeur_user == $a_deviner) {
            $message_success = "Felicitation !";
        }
    }
?>

<main class="container">
    <div class="bg-light p-5 rounded">
        <h1>Jouer</h1>
        <form action="/jeu.php" method="GET">

            <?php if(isset($_GET['valeur']) &&  $valeur_user != null && $message_warning != NULL): ?>
                <div class="alert alert-warning">
                    <p><?= $message_warning ?></p>
                </div>
            <?php endif; ?>

            <?php if(isset($_GET['valeur']) &&  $valeur_user != null && $message_success != NULL): ?>
                <div class="alert alert-success">
                    <p><?= $message_success ?></p>
                </div>
            <?php endif; ?>

            <div class="row">
                <label>Entrer un nombre</label>
                <input name="valeur" type="number" placeholder="Entrer un nombre" value="<?= (isset($_GET['valeur']) &&  $valeur_user != null) ? $valeur_user : ""  ?>">
            </div>
            <div class="row">
                <button class="btn btn-primary mt-2">Valider</button>
            </div>
        </form>
    </div>
</main>

<?php require "footer.php" ?>

