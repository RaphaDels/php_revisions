<?php

//fonction pour vérifier la date (utilisée dans shows_add.php)
    function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }




//Fonction SLUGIFY pour le traitement du nom de l'image au download (utilisée dans shows_add.php)
    //ex : Ch'ti Ambrée devient : chti-ambree
    function slugify($string) {
        $newString = str_replace(' ', '-', $string);
        $newString = str_replace("'", '', $newString);
        $newString = str_replace(
            array(
            'à', 'â', 'ä', 'á', 'ã', 'å',
            'î', 'ï', 'ì', 'í',
            'ô', 'ö', 'ò', 'ó', 'õ', 'ø',
            'ù', 'û', 'ü', 'ú',
            'é', 'è', 'ê', 'ë',
            'ç', 'ÿ', 'ñ',
            ),
            array(
            'a', 'a', 'a', 'a', 'a', 'a',
            'i', 'i', 'i', 'i',
            'o', 'o', 'o', 'o', 'o', 'o',
            'u', 'u', 'u', 'u',
            'e', 'e', 'e', 'e',
            'c', 'y', 'n',
            ),
            $newString
        );
        $newString = mb_strtolower($newString, 'UTF-8');
        return $newString;
    }

