<?php
$title = "Inscription";
$email = null;
$error_msg = null;
$success_msg = null;
if (!empty($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . "emails" . DIRECTORY_SEPARATOR . date("Y-m-d"), $email . PHP_EOL, FILE_APPEND);
        $email = null;
        $success_msg = "Merci de vous etes inscrit.";
    } else {
        $error_msg = "Veuillez enter un email valide !";
    }
}
require "header.php";
?>
<div class="container">
    <h1>Inscrivez-vous a notre newsletter !</h1>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consequatur deleniti eum aliquid hic nam molestiae nisi dignissimos fugiat officiis fuga ad eaque, at, adipisci quasi nesciunt quos tempora fugit nulla.</p>

    <!-- MESSAGE D'ERREUR -->
    <?php if ($error_msg): ?>
        <div class="alert alert-danger">
            <?= $error_msg ?>
        </div>
    <?php endif ?>
    <!-- MESSAGE DE SUCCES -->
    <?php if ($success_msg): ?>
        <div class="alert alert-success">
            <?= $success_msg ?>
        </div>
    <?php endif ?>

    <form action="/newsletter.php" method="post">
        <div class="form-group">
            <input type="email" name="email" id="email_id" class="form-control" value="<?= $email ?>">
        </div>
        <button class="btn btn-primary mt-2">S'inscrire</button>
    </form>
</div>
<?php
require "footer.php";
?>