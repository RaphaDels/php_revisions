<?php 
    require('partials/header.php'); 

    
    //Fonction pour vérifier si une série existe 
    function showExists($id) {
        global $db;     //déclarer $db en global
        $query = $db->prepare('SELECT * FROM `show` WHERE id = :id'); 
        $query->bindValue(':id', $id, PDO::PARAM_INT); 
        $query->execute(); 
        $show = $query->fetch();
        return $show;
    }

    //Je génère une page 404 si elle n'existe pas
    if(empty($_GET['id']) || !$show = showExists($_GET['id'])) {
        http_response_code(404);
    }

?>

<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1><?php echo $show['title']; ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <img class="img-fluid mt-4" src="<?php echo $show['cover']; ?>" alt="<?php echo $show['title']; ?>"/>
        </div>
        <div class="col-md-6">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Catégorie : </strong><?php echo $show['category']; ?></li>
                <!-- convertir la date en format fr -->
                <li class="list-group-item"><strong>Date de sortie : </strong><?php echo date('d/m/Y', strtotime($show['released_at'])); ?></li>
                <li class="list-group-item"><strong>Synopsis : </strong><?php echo $show['synopsis']; ?></li>
            </ul>
        </div>
    </div>
</div>
