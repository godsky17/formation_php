<?php
require "functions.php";
$page_title = "Menu";

// Parfums
$parfums = [
    'Fraise' => 4,
    'Chocolat' => 5,
    'Vanille' => 3,
];

// Cornets
$cornets = [
    'Pot' => 2,
    'Cornet' => 3
];

// Supplements
$supplements = [
    'Chocolat' => 2,
    'Vanille' => 3
];

// Variables
$price = 0;
$share_link = null;

// Affichage du formulaire (checkbox, radio)
$list_parfums = checklist($parfums,  'checkbox', $name = "parfums");
$list_cornets = checklist($cornets, 'radio', $name = "cornets");
$list_supplements = checklist($supplements, 'checkbox', $name = "supplements");

// Traitement
if (isset($_GET['valider'])) {
    $error_msg_parfum = verify(@$_GET['parfums'], 'parfum') ? verify(@$_GET['parfums'], 'parfum') : null;
    $error_msg_cornet = verify(@$_GET['cornets'], 'cornet') ? verify(@$_GET['cornets'], 'cornet') : null;
    $error_msg_supplement = verify(@$_GET['supplements'], 'supplement') ? verify(@$_GET['supplements'], 'supplement') : null;

    if (!empty($_GET['parfums']) && !empty($_GET['cornets'])) {
        $share_link = $_SERVER['REQUEST_URI'];

        $parfum_price = getPrice($_GET['parfums'], $parfums) ?? 0;
        $cornet_price = getPrice($_GET['cornets'], $cornets) ?? 0;
        $supplement_price = getPrice($_GET['supplements'] ?? [], $supplements) ?? 0;
        $price = $parfum_price + $cornet_price + $supplement_price;
    }
}

// LECTURE D'UN FICHIER
$lines = file(__DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "menu_pizza_dessert_custom.tsv");
foreach($lines as $k=>$line){
    $lines[$k] = explode("\t", trim($line));
}


require "header.php";
?>

<main class="container">
    <div class="bg-light p-5 d-flex justify-content-between rounded">
        <div class="<?= $price === 0 ? "col-12" : "col-md-7 col-lg-8" ?>">
            <h1>Creer ton bonheur !</h1>
            <form action="/menu.php" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <p class="lead">Choisit ton parfunm.</p>
                        <div class="form-group">
                            <?php foreach ($list_parfums as $value) {
                                echo $value . "<br/>";
                            } ?>
                        </div>
                        <?php if (isset($_GET['valider']) && empty($_GET['parfums']) && $error_msg_parfum != null): ?>
                            <div class="alert alert-danger">
                                <?= $error_msg_parfum ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-md-4">
                        <p class="lead">Tu le bouffe dans quoi ?</p>
                        <div class="form-group">
                            <?php foreach ($list_cornets as $value) {
                                echo $value . "<br/>";
                            } ?>
                        </div>
                        <?php if (isset($_GET['valider']) && empty($_GET['cornets']) && $error_msg_cornet != null): ?>
                            <div class="alert alert-danger">
                                <?= $error_msg_cornet ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="col-md-4">
                        <p class="lead">Je te rajoute :</p>
                        <div class="form-group">
                            <?php foreach ($list_supplements as $value) {
                                echo $value . "<br/>";
                            } ?>
                        </div>
                        <?php if (isset($_GET['valider']) && empty($_GET['supplements']) && $error_msg_supplement != null): ?>
                            <div class="alert alert-danger">
                                <?= $error_msg_supplement ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <?php if ($price === 0) : ?>
                        <button type="submit" class="btn btn-primary mt-4 " name="valider" value=true>
                            Commander
                        </button>
                    <?php else: ?>
                        <div class="d-flex flex-row mt-4 ">
                            <button type="submit" class="btn btn-primary ms-0 mx-2" name="valider" value=true>
                                Modifier
                            </button>
                            <a href="<?= $share_link != null ? $share_link : "" ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary mx-2">
                                Partager
                            </a>
                            <a href="menu.php" class="btn btn-secondary mx-2">Recommencer</a>
                        </div>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <?php if ($price != 0): ?>
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php foreach ($_GET['parfums'] as $parfum): ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?= $parfum ?></h6>
                                <small class="text-muted">Parfum</small>
                            </div>
                            <span class="text-muted">$<?= $parfums[$parfum] ?></span>
                        </li>
                    <?php endforeach; ?>
                    <?php foreach ($_GET['cornets'] as $cornet): ?>
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0"><?= $cornet ?></h6>
                                <small class="text-muted">Cornet</small>
                            </div>
                            <span class="text-muted">$<?= $cornets[$cornet] ?></span>
                        </li>
                    <?php endforeach; ?>
                    <?php if (!empty($_GET['supplements'])): ?>
                        <?php foreach ($_GET['supplements'] as $supplement): ?>
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?= $supplement ?></h6>
                                    <small class="text-muted">Cornet</small>
                                </div>
                                <span class="text-muted">$<?= $supplements[$supplement] ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$<?= $price ?></strong>
                    </li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-light p-5 roundes">
        <h1>Menu</h1>
        <?php foreach($lines as $line): ?>
            <?php if(count($line) === 1): ?>
                <h2><?= $line[0] ?></h2>
            <?php elseif(count($line) === 3)  : ?>
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            <strong><?= $line[0] ?></strong>
                        </p>
                        <p>
                            <?= $line[1] ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p>
                            <strong><?= $line[2] ?> FCFA</strong>
                        </p>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</main>

<?php require "footer.php" ?>