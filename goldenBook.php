<?php
require "vendor/autoload.php";
use App\GuestBook\{
    GuestBook as gb, Message
};

// Traitement 
$valisation = false;
$errors = [];
$success = null;
$messages = [];
$datas = [];
// Recuperation des messages en base
$book = new gb(__DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "books.txt");

// Traiteement du formulaire
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $datas = [
        'username' => htmlspecialchars($_POST['username']),
        'message' => htmlspecialchars($_POST['message']),
    ];    
    if (!empty($datas['username']) && !empty($datas['message'])) {
        $date_time = new DateTime('now');
        $new_message = new Message($datas['username'], $datas['message'], $date_time);
        $validation = $new_message->isValid();
        if ($validation) 
        {
            $book->addMessage($new_message);
            $success = "Message enregistre !";
            header('Location: /goldenBook.php');
        }else{
            
            $errors = $new_message->getErrors(); 
        }
    } else {
        $errors = [
            'general' => "Veillez remplir convenablement tout les champs."
        ];
    }
}

$messages = $book->getMessages();
?>
<?php require 'header.php' ?>
<div class="col-md-12">
    <h1 class="text-center mb-3">Dites-nous ce que vous pensez de nous !</h1>
    <div class="row form d-flex justify-content-center">
        <form action="" method="post" class="col-md-4">
            <?php if (!$valisation && !empty($errors['general'])): ?>
                <div class="alert alert-danger">
                    <p class="text-center"><?= $errors['general'] ?></p>
                </div>
                <?= $errors = null ?>
            <?php endif ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success">
                    <p class="text-center"><?= $success ?></p>
                </div>
                <?= $success = null ?>
            <?php endif ?>
            <div class="mb-3">
                <label for="username_id" class="form-label">Username</label>
                <input value="<?= htmlentities(@$_POST['username']) ?? '' ?>" type="text" name="username" id="username_id" class="form-control" placeholder="Username">
                <?php if (!$valisation && !empty($errors['username'])): ?>
                    <div class="error">
                        <p><?= $errors['username'] ?></p>
                    </div>
                <?php endif ?>
            </div>

            <div class="mb-3">
                <label for="message_id">Message</label>
                <textarea name="message" id="message_id" placeholder="Message..." class="form-control"><?= !empty($datas) ? $datas['message'] : "" ?></textarea>
                <?php if (!$valisation && !empty($errors['message'])): ?>
                    <div class="error">
                        <p><?= $errors['message'] ?></p>
                    </div>
                <?php endif ?>
            </div>

            
            <button class="btn btn-primary" type="submit">Envoyer</button>
            
            <h2>Liste des messages</h2>
            <?php if (!empty($messages)): ?>
                <?php foreach ($messages as $value){
                    $message = Message::fromJSON($value);
                    $new_date_time = new DateTime();
                    $date = $new_date_time->setTimestamp($message['date']);
                    $message = new Message($message['username'], $message['message'], $date);
                ?>
                    <?= $message->toHTML() ?>
                <?php } ?>
            <?php endif ?>
        </form>
    </div>
</div>
<?php require 'footer.php' ?>