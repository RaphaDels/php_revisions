<?php 
    require('partials/header.php'); 

    //Initialiser les variables du formulaire
    $title = null;
    $category = null; 
    $synopsis = null;
    $cover = null;
    $released_at = null;
    $tvshow_image = null;


    //VERIFIER SI LE FORMULAIRE EST BIEN SOUMIS (DONC REMPLI)
    if(!empty($_POST)) { 
       
        $title = trim(strip_tags($_POST['title']));               //doit faire au moins 1 caractère 
        $category = trim(strip_tags($_POST['category']));         //horreur, drame, humour, policier, fantastique
        $synopsis = trim(strip_tags($_POST['synopsis']));         //doit au moins 10 caractères
        $released_at = trim(strip_tags($_POST['released_at']));       
        
        $errors = [];   

        //Lister et vérifier les erreurs possibles
        if (strlen($title) < 1) {
            $errors['title'] = 'Le titre est trop court';  
        }
        //Vérifier que la catégorie saisie fait bien partie du tbl des choix possibles du select.
        $allowedCategories = ['Horreur', 'Humour', 'Drame', 'Policier', 'Fantastique'];
        if (!in_array($category, $allowedCategories)) {
            $errors['category'] = 'La catégorie n\'est pas valide'; 
        }
        if (strlen($synopsis) < 3) {
            $errors['synopsis'] = 'Le synopsis est trop court';  
        }
        
        //Vérification de la date : option 1 avec une fonction
        /* if (empty($released_at)) {
            $errors['released_at'] = 'La date n\'est pas définie';  
        } else if (!validateDate($released_at, 'Y-m-d')){
            $errors['released_at'] = 'La date est incorrecte';  
        } */
        
        //option 2, en 2 temps : avec strtotime() puis checkdate()
        if (!strtotime($released_at)) {     //ex s'il a saisi 'toto'
            $errors['released_at'] = 'La date saisie est incorrecte';  
        }
        if (strtotime($released_at)) {     
            $month = date('n',strtotime($released_at));
            $day = date('j',strtotime($released_at));
            $year = date('Y',strtotime($released_at));
            
            if (!checkdate($month, $day, $year)) {
                $errors['released_at'] = 'La date n\'est pas valide'; 
            }     
        }
        var_dump($errors);
  

        //VERIFICATION DE L'IMAGE UPLOADEE
        //Pas besoin de vérifier si l'image est uplaodée car ce n'est pas obligatoire d'en mettre une.
        
        //Pour les formats autorisés : vérifier le type MIME de l'image uploadée avec finfo_file()
        if ($tvshow_image) {
            $file = $tvshow_image['tmp_name']; //l'emplacement temporaire du fichier uploadé
            $finfo = finfo_open(FILEINFO_MIME_TYPE); //permet d'ouvrir un fichier
            $mimeType = finfo_file($finfo, $file); //ouvre le fichier et renvoie  image/img
            //créer un tbl pour les mime types autorisés : 
            $allowedExtensions = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            //vérifier si le mime type obtenu ne figure pas dans ce tbl :
            if (!in_array($mimeType, $allowedExtensions)) {
                $errors['tvshow_image'] = 'Ce type de fichier n\'est pas autorisé';
            }
        }

        //Vérifier la taille de l'image uploadée (2Mo = 2 097 152 octets)
        if ($tvshow_image['size'] > 2097152) {
            $errors['tvshow_image'] = 'Ce fichier est trop lourd.';
        }
        
    
        //QUAND LE FORMULAIRE N'EST PAS VALIDE => bloc rouge au-dessus du formulaire qui liste les erreurs
        if (!empty($errors)) {
            echo '<div class="alert alert-danger">'; 
            foreach ($errors as $error) {
                echo '<p>'.$error.'</p>';
            }
            echo '</div>';
        }

        //QUAND LE FORMULAIRE EST VALIDE (TBL D'ERREUR VIDE) => AJOUTER LA SERIE EN BDD
        if (empty($errors)) {
            
            $query = $db->prepare('
            INSERT INTO `show` (title, category, synopsis, released_at, cover)  
            VALUES (:title, :category, :synopsis, :released_at, :tvshow_image)
            '); 
            $query->bindValue(':title', $title, PDO::PARAM_STR);
            $query->bindValue(':category', $category, PDO::PARAM_STR);
            $query->bindValue(':synopsis', $synopsis, PDO::PARAM_STR);
            $query->bindValue(':released_at', $released_at, PDO::PARAM_STR);
            $query->bindValue(':tvshow_image', null, PDO::PARAM_STR); //on met null car on ajoute la série d'abord sans image puis on la rajoute une fois l'upload traité (extension, taille...)
        
            //Insère la série dans la bdd en executant la fonction
            if ($query->execute()) {
                
                //METTRE CONDITION SI PHOTO EST UPLOADEE (sinon on a une notice)

                    //upload de l'image (en récupérant son emplacement temporaire)
                    $file = $_FILES['tvshow_image']['tmp_name'];
                    //récupération de l'extension (jpg...)
                    $originalName = $_FILES['tvshow_image']['name'];
                    $extension = pathinfo($originalName)['extension'];
                    //slugifier le nom de l'image et le concatener avec l'extension
                    $name = slugify($title);
                    $filename = $name.'.'.$extension;
                    var_dump($filename);

                    //Déposer le fichier dans le dossier img
                    move_uploaded_file($file, __DIR__.'/img/'.$filename);

                //REQUETE pour mettre à jour la série en bdd afin d'associer l'image uploadée
                $query = $db->prepare('UPDATE `show` SET `cover` = :tvshow_image WHERE id = :id');
                $query->bindValue(':tvshow_image', 'img/'.$filename, PDO::PARAM_STR);
                $query->bindValue(':id', $db->lastInsertId(), PDO::PARAM_INT); //on récupère l'id de la dernière série ajoutée
                $query->execute();

                echo '<div class="alert alert-success">Félicitations ! La série a bien été ajoutée !</div>';
            } else { //pour débuguer si pb au moment de l'execution
                echo 'Erreur insert';
            }
        }
    } //end of if(!empty($_POST))
?>


<!-- Le contenu de la page -->
<div class="container pt-5">
    <h1>Ajouter une série</h1>

        <div class="row pt-3">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" class="form-control <?php echo isset($errors['title']) ? 'is-invalid' : null; ?>" name="title" id="title" placeholder="Titre">
                    <?php //message d'erreur en rouge en-dessous du champ concerné (en plus du php dans la classe de l'input)
                    if (!empty($errors['title'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['title'];
                        echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <label for="category">Catégorie</label>
                    <select class="form-control <?php echo isset($errors['category']) ? 'is-invalid' : null; ?>" name="category" id="category">
                        <option value="">Choisir une catégorie</option>
                        <option value="Drame">Drame</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Humour">Humour</option>
                        <option value="Policier">Policier</option>
                        <option value="Fantastique">Fantastique</option>
                    </select>
                    <?php //message d'erreur en rouge en-dessous du champ concerné   
                    if (!empty($errors['category'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['category'];
                        echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <label for="synopsis">Synopsis</label>
                    <textarea class="form-control <?php echo isset($errors['synopsis']) ? 'is-invalid' : null; ?>" name="synopsis" id="synopsis" rows="4"></textarea>
                    <?php //message d'erreur en rouge en-dessous du champ concerné  
                    if (!empty($errors['synopsis'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['synopsis'];
                        echo '</div>';
                    } ?>
                </div>
                <div class="form-group">
                    <label for="released_at">Date de sortie</label>
                    <input type="date" class="form-control <?php echo isset($errors['released_at']) ? 'is-invalid' : null; ?>" name="released_at" id="released_at">
                    <?php //message d'erreur en rouge en-dessous du champ concerné  
                    if (!empty($errors['released_at'])) {
                        echo '<div class="invalid-feedback">';
                            echo $errors['released_at'];
                        echo '</div>';
                    } ?>
                </div>
                <div>
                    <!-- Ne fonctionne pas car le label n'est pas cliquable. Pour camoufler l'affreux bouton d'upload : si le label est cliquable de base, mettre les classes btn et btn-success sur le label + display none sur l'input. 
                        <p>Télécharger une image : </p>
                        <label class="btn btn-success "for="tvshow_image">Télécharger l'image</label>
                        <input class="d-none" type="file" name="tvshow_image"/>
                    -->
                    <label class=""for="tvshow_image">Télécharger</label>
                    <input class="" type="file" name="tvshow_image"/>
                </div>
                <div class="">
                   <button type="submit" class="btn btn-light my-2" style="background-color: #D8B2CE;">Ajouter !</button>
                </div>    
            </form>
        </div>
    </div>
</div>