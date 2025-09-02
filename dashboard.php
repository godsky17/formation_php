<?php
require "functions.php";
require './functions/auth.php';
if(is_connected()){
    var_dump("Un utilisateur est connecte");
}
$select_year = !empty($_GET['year']) ? (int)$_GET['year'] : date('Y');
$select_month = !empty($_GET['month']) ? (int)$_GET['month'] : date('m');
$total = getNbrVist();
$months = [
    "01" => "Janvier",
    "02" => "Fevrier",
    "03" => "Mars",
    "04" => "Avril",
    "05" => "Mai",
    "06" => "Juin",
    "07" => "Juillet",
    "08" => "Aout",
    "09" => "Septembre",
    "10" => "Octobre",
    "11" => "Novembre",
    "12" => "Decembre",
];
// 
if ($select_month && $select_month) {
    $stats = getNbrVisitPerMonth($select_year, $select_month);
    $total = $stats['total'] ? $stats['total'] : 0;
    $details =  $stats['details'] ? $stats['details'] : "Aucune statisitique disponible pour cette periode.";
}
require "header.php"
?>

<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="list-group">
                <?php for ($i = 0; $i < +5; $i++): ?>
                    <a href="./dashboard.php?year=<?= date('Y') - $i ?>" class="list-group-item <?= $select_year ===  (date('Y') - $i) ? "active" : "" ?>"><?= date('Y') - $i ?></a>
                    <?php if ($select_year === (date('Y') - $i)): ?>
                        <?php foreach ($months as $m => $month): ?>
                            <a href="./dashboard.php?year=<?= date('Y') - $i ?>&month=<?= $m ?>" class="list-group-item <?= $m == $select_month ? "active" : "" ?>"><?= $month ?></a>
                        <?php endforeach ?>
                    <?php endif ?>
                <?php endfor ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body mb-4">
                    <strong style="font-size: 3em;"><?= $total ?></strong><br>
                    <p>Visite total</p>
                </div>
            </div>

            <?php if($details && is_array($details)): ?>
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Jour</th>
                                <th scope="col">Vue(s)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($details as $detail): ?>
                                <tr>
                                    <td><?= $detail['jour'] ?></td>
                                    <td><?= $detail['vue'] ?></td>
                                </tr>
                             <?php endforeach ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center h3 p-5">
                        <?= $details ?>
                    </p>
                <?php endif ?>
        </div>
    </div>
</div>
<?php require "footer.php" ?>