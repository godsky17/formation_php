<?php
    require_once './functions.php';
    function nav_item(string $lien, string $titre): string
    {
        $classe = "nav-link";
        if ($_SERVER['SCRIPT_NAME'] === $lien) {
            $classe .= ' active';
        }
        return '<li class="nav-item">
            <a class="' . $classe . '" aria-current="page" href="' . $lien . '">' . $titre . '</a>
            </li>';
    }
    
    compteur();
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""> 
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.84.0">
        <title><?= isset($page_title) ? $page_title : "Mon site"  ?></title>

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/navbar-static/">

        

        <!-- Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
        <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
        <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
        <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
        <meta name="theme-color" content="#7952b3">


        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>

        
        <!-- Custom styles for this template -->
        <link href="navbar-top.css" rel="stylesheet">
    </head>
    <body>
    
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mon site</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <?= nav_item('/index.php', 'Acceuil') ?>
                <?= nav_item('/menu.php', 'Menu') ?>
                <?= nav_item('/jeu.php', 'Jeu') ?>
                <?= nav_item('/newsletter.php', 'Newslettrer') ?>
                <?= nav_item('/goldenBook.php', 'Vos avis') ?>
                <?= nav_item('/meteo.php', 'Meteo') ?>
                <?= nav_item('/blog.php', 'Blog') ?>
                <?= nav_item('/contact.php', 'Contact') ?>
            </ul>
            </div>
        </div>
        </nav>