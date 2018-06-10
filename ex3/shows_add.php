<?php 

    require('partials/header.php'); 

    //Initialiser les variables du formulaire
    $title = null;
    $category = null; 
    $synopsis = null;
    $cover = null;
    $released_at = null;
    $tvshow_image = null;

    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

   

    //VERIFIER SI LE FORMULAIRE EST BIEN SOUMIS (DONC REMPLI)
    if(!empty($_POST)) { 
       
        $title = $_POST['title'];               //doit faire au moins 3 caractères 
        $category = $_POST['category'];         //horreur, drame, humour, policier, fantastique
        $synopsis = $_POST['synopsis'];         //doit au moins 10 caractères
        $released_at = $_POST['released_at'];   // ?      
        

        $errors = [];   

        //Lister et vérifier les erreurs possibles
        if (strlen($title) < 3) {
            $errors['title'] = 'Le titre est trop court';  
        }
        //Verifier que la catégorie saisie fait bien partie des choix possibles du select. Je crée un tbl avec les valeurs possibles
        $allowedCategories = ['Horreur', 'Humour', 'Drame', 'Policier', 'Fantastique'];
        if (!in_array($category, $allowedCategories)) {
            $errors['category'] = 'La catégorie n\'est pas valide'; 
        }
        if (strlen($synopsis) < 11) {
            $errors['synopsis'] = 'Le synopsis est trop court';  
        }
        if (empty($released_at)) {
            $errors['released_at'] = 'La date n\'est pas définie';  
        } else if (!validateDate($released_at, 'Y-m-d')){
            $errors['released_at'] = 'La date est incorrecte';  
        }
        var_dump($errors);
  
        //QUAND LE FORMULAIRE N'EST PAS VALIDE => bloc rouge au dessus du formulaire
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">'; 
            foreach ($errors as $error) {
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }

        //QUAND LE FORMULAIRE EST VALIDE (LE TBL D'ERREUR EST VIDE) => AJOUTER LA SERIE
        if (empty($errors)) {
            $query = $db->prepare('
            INSERT INTO `show` (title, category, synopsis, released_at, cover)  
            VALUES (:title, :category, :synopsis, :released_at, :tvshow_image)
            '); 
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':category', $category, PDO::PARAM_STR);
            $query->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
            $query->bindValue(':released_at', $released_at, PDO::PARAM_STR);
            $query->bindValue(':tvshow_image', null, PDO::PARAM_STR); 
        

            //Insère la série dans la bdd en executant la fonction
            if ($query->execute()) {
                echo '<div class="alert alert-success">La série a bien été ajoutée !</div>';
            } else {
                echo 'Erreur insert';
            }
           
        }
    } //end of if(!empty($_POST))
?>


<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Ajouter une série</h1>

        <div class="row pt-3">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Titre">
                </div>
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select class="form-control" name="category" id="category">
                        <option value="">Choisir une catégorie</option>
                        <option value="Drame">Drame</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Humour">Humour</option>
                        <option value="Policier">Policier</option>
                        <option value="Fantastique">Fantastique</option>
                    </select>
                    <?php //pour mettre le message d'erreur en rouge en-dessous du champ concerné
                    if (!empty($errors['category'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['category'];
                        echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea class="form-control" name="synopsis" id="synopsis" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="released_at">Date de sortie</label>
                    <input type="date" class="form-control" name="released_at" id="released_at">
                </div>
                <div>
                    <label for="tvshow_image">Télécharger l'image </label>
                    <input type="file" name="tvshow_image" formenctype="multipart/form-data" />
                </div>
                <div class="">
                   <button type="submit" class="btn btn-light my-2">Ajouter !</button>
                </div>    
            </form>
        </div>
    </div>
</div>