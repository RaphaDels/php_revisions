<?php
//on indique les chemins d'accès par rapport au header, pas par rapport à index.php
require(__DIR__.'/../config/database.php');
require(__DIR__.'/functions.php');
?>

<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Lien vers style.css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Bowlby+One+SC" rel="stylesheet">

    <title>Révisions - Exo séries</title>
  </head>
  
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #D8B2CE;">
        <div class="container">
            <img class="logo mr-1" src="img/tv.png"/> 
            <a class="navbar-brand" href="index.php"> TV Shows</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarSupportedContent">                
                <!-- Pour appliquer la classe active à la page affichée (+ partie dans le <li>) -->
                <?php $page = basename($_SERVER['REQUEST_URI'], '.php'); ?>
                
                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item <?php echo ($page == 'index') ? 'active' : '' ?>">
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown <?php echo ($page == 'shows_list') ? 'active' : '' ?>">
                        <a class="nav-item nav-link" href="shows_list.php">Les séries <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown <?php echo ($page == 'shows_add') ? 'active' : '' ?>">
                        <a class="nav-item nav-link" href="shows_add.php">Ajouter une série <span class="sr-only">(current)</span></a>
                    </li>

                    <!-- 
                    Si un utilisateur existe dans la session, on affiche son email et un lien vers logout.php pour se déconnecter.
                    S'il n'y a pas d'utilisateur dans la session on affiche les 2 liens pour s'inscrire et se connecter -->
<!--                     <?php /*  
                        if (isset($_SESSION['user'])) { ?>
                            <li class="nav-item">
                                <span class="navbar-text text-warning">
                                    <?php echo 'Hello '.$_SESSION['user']['login'].' !'; ?>
                                </span>
                            </li>
                            <li class="nav-item <?php echo ($page == 'logout') ? 'active' : '' ?>">

                                <a class="nav-link" href="logout.php">Se déconnecter <span class="sr-only">(current)</span></a>
                            </li>
                    <?php } else { //si pas d'utilisateur connecté ?> 
                            <li class="nav-item <?php echo ($page == 'register') ? 'active' : '' ?>">
                                <a class="nav-link" href="register.php">S'inscrire <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item <?php echo ($page == 'login') ? 'active' : '' ?>">
                                <a class="nav-link" href="login.php">Se connecter<span class="sr-only">(current)</span></a>
                            </li>
                    <?php }  */ ?> -->
                </ul>
            </div>
        </div>    
    </nav>
