    <div class="row">
        <div class="col-md"></div>
        <div class="col-md"></div>
        <div class="col-md">
            <?php 
                require "vendor/autoload.php";
                use App\Compteur;
                require_once __DIR__ . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "Compteur.php";
                $compteur = new Compteur(__DIR__ . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'compteur.txt');
                $compteur->incrementer();
                $vues = $compteur->recuperer();
            ?>
            <p>Le site a ete visite <?= $vues ?> fois</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>