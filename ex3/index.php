<?php
require('partials/header.php');

/* Gestion de séries

Nous voulons pouvoir gérer nos séries et pourquoi pas gérer le visionnage de nos saisons et épisodes favoris. On va créer une base de données nommée tvshow. On a le choix d'utiliser MySQL Workbench pour créer le schéma facilement ou créer nos tables directement sur PHPMyAdmin.

Nous allons tout d'abord créer la table 'show' qui va représenter les séries.
    id (ne pas oublier l'auto increment)
    title VARCHAR
    category VARCHAR
    cover VARCHAR NULL
    synopsis TEXT
    released_at DATE

Créer une page contenant un formulaire permettant d'ajouter une série. Tous les champs sont obligatoires sauf cover. Title, category et synopsis doivent faire au moins 3 caractères. Le champ released_at doit être une date valide. Les messages d'erreurs doivent apparaitre en dessous du champ concerné.

Créer une page permettant d'afficher la liste de nos séries sans le synopsis.

Créer une page permettant de voir une série en détail. On pourra lire le synopsis à partir de cette page. */

?>


<!-- Le contenu de la page d'accueil -->
<div class="container pt-5">
    <h1>Bienvenue sur TVsh📺ws</h1>

    <div class="row pt-3">
        
    </div>


</div>



    
