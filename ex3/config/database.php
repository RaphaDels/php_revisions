<?php

//je définis les constantes

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'tvshow');


//chaine de connexion à la base de données (entre php et mysql)

$db = new PDO('mysql:host='.HOST.';dbname='.DB.';charset=utf8', USER, PASS, [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);


    