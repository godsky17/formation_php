<?php
define('JOURS', [
    'Lundi',
    'Mardi',
    'Mercredi',
    'Jeudi',
    'Vendredi',
    'Samedi',
    'Dimanche'
]);

define('CRENEAUX', [
    0 => [
        [8, 12],
        [14, 19]
    ],
    1=> [
        [8, 12],
        [14, 19]
    ],
    2 => [
        [8, 12]
    ],
    3 => [
        [8, 12],
        [14, 23]
    ],
    4 => [
        [8, 12],
        [14, 17]
    ],
    5 => [
        [8, 12],
    ],
    6 => [
    ]
]);

define('FILE', __DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "compteur.txt");
define('FILEPERDAY', __DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "compteur_" . date('Y-m-d'). ".txt");
define('NBRVISIT', 1);
define('USERS', __DIR__ . DIRECTORY_SEPARATOR . "datas" . DIRECTORY_SEPARATOR . "users.txt");