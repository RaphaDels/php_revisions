<?php 
/* Créer un tableau PHP contenant une liste de contacts. Voici la liste des contacts : 
    Auguste Fréchette, 30 novembre 1942, 92190 MEUDON, 01.22.88.26.88
    Algernon Duranseau, 2 novembre 1966, 91190 GIF-SUR-YVETTE, 01.80.31.88.75
    Armand Duplessis, 29 juillet 1953, 77380 COMBS-LA-VILLE, 01.07.46.25.64
    Zacharie LaGrande, 27 février 1990, 80090 AMIENS, 03.02.52.82.94
    Aubrey Bourassa, 14 novembre 1982, 33800 BORDEAUX, 05.55.59.61.44
La date doit être stockée dans le tableau sous la forme d'un timestamp.
Nous voulons ce rendu final pour chacun des contacts : 
Auguste Fréchette est né le 30 novembre 1942, il a 75 ans. Il habite à Meudon (92190). Il est joignable au 01 22 88 26 88. */

    $contacts = [
        [
            'firstname' => 'Auguste',
            'lastname'=> 'Fréchette',
            'dob' => strtotime('30 november 1942'),
            'zip'=> '92190',
            'city'=> 'MEUDON',
            'phone'=> '01.22.88.26.88',
            'gender'=> 'M',
        ], [
            'firstname' => 'Algernon',
            'lastname'=> 'Duranseau',
            'dob' => strtotime('29 july 1953'),
            'zip'=> '77380',
            'city'=> 'GIF-SUR-YVETTE',
            'phone'=> '01.80.31.88.75',
            'gender'=> 'M',
        ], [
            'firstname' => 'Armand',
            'lastname'=> 'Duplessis',
            'dob' => strtotime('2 november 1966'),
            'zip'=> '91190',
            'city'=> 'COMBS-LA-VILLE',
            'phone'=> '01.07.46.25.64',
            'gender'=> 'M',
        ], [
            'firstname' => 'Zacharie',
            'lastname'=> 'LaGrande',
            'dob' => strtotime('27 february 1990'),
            'zip'=> '80090',
            'city'=> 'AMIENS',
            'phone'=> '03.02.52.82.94',
            'gender'=> 'M',
        ], [
            'firstname' => 'Audrey',
            'lastname'=> 'Bourassa',
            'dob' => strtotime('14 november 1982'),
            'zip'=> '33800',
            'city'=> 'BORDEAUX',
            'phone'=> '05.55.59.61.44',
            'gender'=> 'F',
        ],
    ];

    //var_dump($contacts['dob']);


//TRADUIRE LA DATE EN FR. 2 méthodes : 

    //Méthode 1) Créer un tbl avec les 12 mois qu'on appelle par leur index dans le foreach
        $months = [
            'janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'
        ];
        /* puis dans le foreach : 
            $day = date('j ', $contact['dob']);
            $month = $months[date('n', $contact['dob']) - 1];
            $year = date(' Y', $contact['dob']);
            Dans la concaténation je mets : ...est né le '.$day.$month.$year
        */

    //Méthode 2) Utiliser setLocale() + strftime()
        //(inconvénient : la langue doit être instalée sur le serveur sinon ça ne fonctionne pas)
        $locale = setLocale(LC_TIME, 'fr');
        //Ne pas oublier utf8_encode() pour gérer les accents

//CALCUL DE L'AGE
    //fonction pour calculer l'âge
        function getAge($_dob) {
            $formated_date = date('Y-m-d', $_dob);
            $today = date("d-m-Y");
            $diff = date_diff(date_create($formated_date), date_create($today));
            //retourne la différence entre les deux dates au format "années"
            return $diff->format('%y');
        }

    //Calcul de l'âge 
        $dateToday = time(); //donne le timestamp du jour
        $dateBirthday = strtotime('18 november 1991'); //donne le timestamp d'une date donnée !! mettre le mois en anglais
        echo floor(($dateToday - $dateBirthday) / (365 * 24 * 60 * 60)); // => pb pour les années bisextiles, pas précis

    //Avec diff (VOIR CORRECTION DE MATHIEU SUR GIT)


?>

<div style="font-family: arial;">
    <?php 
    foreach ($contacts as $contact) {
        $birthdate = utf8_encode(strftime('%d %B %Y', $contact['dob']));

        if ($contact['gender'] == 'M') {
            echo '<p>'.$contact['firstname'].' '.$contact['lastname'].' est né le '.$birthdate.', il a '.getAge($contact['dob']).' ans. Il habite à '.ucfirst(strtolower($contact['city'])).' ('.$contact['zip'].'). Il est joignable au '.str_replace('.', ' ', $contact['phone']).'.<br/></p>';
        } else {
            echo '<p>'.$contact['firstname'].' '.$contact['lastname'].' est née le '.$birthdate.', elle a '.getAge($contact['dob']).' ans. Elle habite à '.ucfirst(strtolower($contact['city'])).' ('.$contact['zip'].'). Elle est joignable au '.str_replace('.', ' ', $contact['phone']).'.<br/></p>';
        }
    } ?>
</div>


<!--
Problèmes :
- affichage du nom de la ville avec une majuscule seulement sur le premier mot (ex: Gif-sur-yvette)  
    ucfirst(strtolower($contact['city'])) => passe toutes les lettres en minuscules sauf la première qui reste en maj 

    ucwords() met des majuscules à chaque mot (après un espace) 


- affichage des mois en anglais (ex: né le 30 November 1942)    
    !!! strtotime('4 may 1981') ne fonctionne qu'avec des mois en anglais
    Dans la concaténation, remplace : date('j F Y', $contact['dob']) qui donne les mois en anglais
        

-->
