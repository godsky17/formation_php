<?php 
$msg_success = null;
$error = [];
//Recuperer et afficher les posts de la bd
$path_db = __DIR__ . DIRECTORY_SEPARATOR . 'datas' . DIRECTORY_SEPARATOR . 'bd_sql.db';
$pdo = new PDO('sqlite:' . $path_db, null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Pour relever les erreurs
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //Retourner le resultat sous forme d'objet
    PDO::ATTR_TIMEOUT => 5
]);

try {

    //Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['title']) && !empty($_POST['content'])) {
            $title = htmlentities($_POST['title']);
            $content = htmlentities($_POST['content']);
            $query = $pdo->prepare("INSERT INTO posts(title, content, created_at) VALUES (:title, :content, :created_at)");
            $query->execute([
                'title' => $title,
                'content' => $content,
                'created_at' => time()
            ]);
            $msg_success = "Post enregistre !";
        }else{
            $error[ 'general' ] = "Veuillez remplire convenablement les champs !";
        }
    }
    
    $query = $pdo->query("SELECT * FROM posts");
    $posts = $query->fetchAll();
} catch (Exception $e) {
    echo $e->getMessage();
}
require "header.php" 
?>

<div class="row px-5">
    <div class="col-md-8">

        <?php if(count($posts) <= 0): ?>
            <div class="text-center my-5">
                <h2>Oups ! </h2>
                <p>Aucun article n'est disponible</p>
            </div>
        <?php else: ?>
            <h2>Article</h2>
            <div class="row">
                <?php foreach ($posts as $post): ?>
                <div class="col-6 col-md-6 col-sm-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $post->title ?? $post->title->date_format('Y/m/d H:i') ?></h5>
                            <p class="card-text"><?= substr(nl2br($post->content), 0, 150) ?></p>
                            <a href="#" class="btn btn-primary">Go </a>
                            <a href="/edit.php?id=<?= $post->id ?> " class="btn btn-secondary">Edit </a>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>
    <div class="col-md-4">
        <form action="./blog.php" method="post">
            <h2>Ecrivez votre poste</h2>

            <?php if(!empty($msg_success)): ?>
        <div class="alert alert-success">
            <p><?= $msg_success ?></p>
        </div>
        <?php endif ?>

        <?php if(!empty($error['general'])): ?>
            <div class="alert alert-danger">
                <p><?= $error['general'] ?></p>
            </div>
        <?php endif ?>


            <div class="form-group mb-2">
                <label for="title_id">Titre</label>
                <input type="text" name="title" id="title_id" class="form-control" placeholder="Titre de l'article">
            </div>
            <div class="form-group mb-2">
                <label for="content_id">Contenu</label>
                <textarea name="content" id="content_id" placeholder="Votre article" class="form-control"></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Poster</button>
        </form>
    </div>
</div>

<?php require "footer.php" ?>