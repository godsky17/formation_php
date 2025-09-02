<?php
session_start();
// Recuperation de tous les utilisateurs
function findUsers(){
    $users = file("../datas/users.txt");
    foreach($users as $user){
        $user = explode("   ", $user);
        $users_fine[] = [
            "id" => $user[0],
            "password" => $user[1]
        ];
    }
    return $users_fine;
}

function findUserWithEmail(array $users, string $email){
    foreach ($users as $key => $user) {
        if(in_array($email, $user)){
            return $users[$key];
        }
    }
    return "Utlisateur introuvable";
}
// Connexion
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    // Recuperation des utilisateur dans la bd
    $users = findUsers();
    // Recherche de l'utilisateur
    $user = findUserWithEmail($users, $email);
    if(is_string($user)){
        // retourner a la page de connexion avec une erreur
        $_SESSION['CON_ERROR_MSG'] = $user;
        header('Location: ../connexion.php');
    }else{
        // Verifier si le mot de passe est correct
        if($password === trim($user['password'])){
           $_SESSION['utilisateur'] = [
            'user' => $email,
            'password' => $password
           ];
            header("Location: ../dashboard.php");
        }else{
            var_dump($user['password'], $password, ($password == trim($user['password'])));
            die();
            $_SESSION['CON_ERROR_MSG'] = "Identifiant ou mot de passe incorrect";
            header('Location: ../connexion.php');
        }
    }
    var_dump($users);
    die();
}

function is_connected()
{
    
    if(!empty($_SESSION['utilisateur'])){
        // verifier si l'id e le mot de passe en session sont les memes que dans la bd
    }else{
        $connexion_path = __DIR__ . DIRECTORY_SEPARATOR . "connexion.php";
        header("Location: connexion.php");
        return false;
    }

}
