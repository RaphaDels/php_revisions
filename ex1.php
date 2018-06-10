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
            'sex'=> 'M',
        ], [
            'firstname' => 'Algernon',
            'lastname'=> 'Duranseau',
            'dob' => strtotime('29 july 1953'),
            'zip'=> '77380',
            'city'=> 'GIF-SUR-YVETTE',
            'phone'=> '01.80.31.88.75',
            'sex'=> 'M',
        ], [
            'firstname' => 'Armand',
            'lastname'=> 'Duplessis',
            'dob' => strtotime('2 november 1966'),
            'zip'=> '91190',
            'city'=> 'COMBS-LA-VILLE',
            'phone'=> '01.07.46.25.64',
            'sex'=> 'M',
        ], [
            'firstname' => 'Zacharie',
            'lastname'=> 'LaGrande',
            'dob' => strtotime('27 february 1990'),
            'zip'=> '80090',
            'city'=> 'AMIENS',
            'phone'=> '03.02.52.82.94',
            'sex'=> 'M',
        ], [
            'firstname' => 'Audrey',
            'lastname'=> 'Bourassa',
            'dob' => strtotime('14 november 1982'),
            'zip'=> '33800',
            'city'=> 'BORDEAUX',
            'phone'=> '05.55.59.61.44',
            'sex'=> 'F',
        ],
    ];

    //var_dump($contacts);

    function getAge($_dob) {
        $formatted_date = date('Y-m-d', $_dob);
        $today = date("d-m-Y");
        $diff = date_diff(date_create($formatted_date), date_create($today));
        return $diff->format('%y'); //return $diff->format('%yYears, %mMonths, %dDays');
    }
    //echo getAge("1949-05-26");
    //echo '<br/>'; 

    foreach ($contacts as $contact) {
        if ($contact['sex'] == 'M') {
            echo $contact['firstname'].' '.$contact['lastname'].' est né le '.date('j F Y', $contact['dob']).', il a '.getAge($contact['dob']).' ans. Il habite à '.ucfirst(strtolower($contact['city'])).' ('.$contact['zip'].'). Il est joignable au '.$contact['phone'].'.<br/>';
        } else {
            echo $contact['firstname'].' '.$contact['lastname'].' est née le '.date('j F Y', $contact['dob']).', elle a '.getAge($contact['dob']).' ans. Elle habite à '.ucfirst(strtolower($contact['city'])).' ('.$contact['zip'].'). Elle est joignable au '.$contact['phone'].'.<br/>';
        }
    }

    // !!! strtotime('4 may 1981') ne fonctionne qu'avec des mois en anglais
    //ucfirst(strtolower($contact['city'])) => passe toutes les lettres en minuscules sauf la première qui reste en maj 