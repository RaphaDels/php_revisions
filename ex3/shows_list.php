<?php 
    require('partials/header.php'); 

    
    //Requête pour récupérer la liste des séries
    $query = $db->query('SELECT * FROM `show`');
    $shows = $query->fetchAll();
    //var_dump($shows);


?>


<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Les séries</h1>

    <div class="row pt-3">
        <?php
            foreach ($shows as $show) { 
                echo '<div class="col-md-3">';
                    echo '<div class="card mb-4 box-shadow">';
                        //echo '<img class="beer-img d-block card-img-top" src="'.$show['image'].'"/>';
                        echo '<div class="card-body">';
                            echo '<p class="text-center font-weight-bold">';
                                echo $show['title'];
                            echo '</p>';
                            echo '<p class="text-center">';
                                echo 'Catégorie : '.$show['category'].'<br/>';
                            echo '</p>';
                            //ajouter un bouton (a href) voir la série. quand on clique on arrive sur la page shows_single.php. Il faudrait que l'url ressemble à shows_single.php?id=IdDeLaSerie
                            echo '<a href="shows_single.php?id='.$show['id'].'" class="btn btn-light d-block m-auto">+</a>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            } 
        ?>
    </div>









</div>