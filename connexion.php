<?php
session_start();
require 'header.php'
?>
<div class="container">
    <h1 class="text-center">Page de connexion</h1>
    <?php if (!empty($_SESSION['CON_ERROR_MSG'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['CON_ERROR_MSG'] ?>
        </div>
        <?php $_SESSION['CON_ERROR_MSG'] = ""; ?>
    <?php endif ?>
    <form action="./functions/auth.php" method="post">
        <div class="form-group">
            <label for="email_id">Email</label>
            <input type="email" name="email" id="email_id" class="form-control" placeholder="Entrer votre email">
        </div>
        <div class="form-group">
            <label for="password_id">Mot de passe</label>
            <input type="password" name="password" id="password_id" class="form-control">
        </div>

        <div class="m-2 ms-0">
            <a href="" class="text-end">Mot de passe oublier</a>
        </div>

        <div class="mt-5">
            <button type="submit" class="btn btn-primary">Connexion</button>
        </div>
    </form>
</div>
<?php require 'footer.php' ?>