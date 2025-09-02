<?php
$show = true;
$date = $_COOKIE['user_age'];
if (!empty($_POST['date_of_birth'])) {
    $data = htmlspecialchars($_POST['date_of_birth']);
    setcookie('user_age', $data);
}
if (!empty($date)) {
    $user_year = date('Y') - date('Y', strtotime($date));
    var_dump($user_year);
    if($user_year >= 18) {
        $show = false;
    } 
}

require "./header.php";
?>

<div class="container">
    <?php if($show): ?>
    <!-- DEMANDER LA DATE DE NAISSANCE -->
    <form action="./nsfw.php" method="post" class="">
        <div class="form-group">
            <input type="date" name="date_of_birth" id="" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Acceder</button>
    </form>
    <?php else : ?>
        <h1>Bienvenu sur la page interdite</h1>
    <?php endif ?>

</div>

<?php require "./footer.php" ?>