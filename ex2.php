<?php

/* Créer une fonction permettant de convertir des degrès celsius en fahrenheit et inversement.
Des messages devront s'afficher en fonction de la température (celle en Celsius :)).

En dessous de 0 : Il fait très froid.
Entre 0 et 14 degrès : C'est le nooord.
Entre 15 et 25 degrès : Il fait bon.
Au dessus de 25 degrès : Il fait trop chaud.

Exemple du code :
    echo degree(27, 'F'); // Affiche "Il fait trop chaud. 27°C équivaut à 80.6°F."
    echo degree(41, 'C'); // Affiche "C'est le nooord. 41°F équivaut à 5°C."
*/
// 0°C = 32°F / 1°C = 33.8°F / 2°C = 35.6°F / 1°F = -17.2222°C


function degree($_temperature, $_unit) {
    $_val = 0;
    $_return = '';
    $_from_unit = '';
    $_to_unit = '';

    //conversion Fahrenheit en Celsius
    if($_unit == 'C'){
        $_val = ($_temperature - 32) / 1.8;
        $_from_unit = '°F';
        $_to_unit = '°C';
    } 
    //conversion Celsius en Fahrenheit
    if ($_unit == 'F') {
        $_val = ($_temperature * 1.8) + 32;
        $_from_unit = '°C';
        $_to_unit = '°F';
    }
   
    if ($_val < 0 ) {
        $_message = 'Il fait très froid. ';
    } else if ($_val >= 0 && $_val <= 14) {
        $_message = 'C\'est le noooord. ';
    } else if ($_val >= 15 && $_val <= 25) {
        $_messagen =  'Il fait bon. ';
    } else if ($_val > 25) {
        $_message =  'Il fait trop chaud. ';
    }

    //concaténation des variables et du texte
    //return $_message.' '.$_temperature.$_from_unit.' équivaut à '.$_val.$_to_unit.'.';
    
    //équivaut à : 
    $_message .= $_temperature.$_from_unit;
    $_message .= ' équivaut à ';
    $_message .= $_val.$_to_unit.'.';
    return $_message;
}
?> 

<div style="font-family: arial;">
    <?php
        echo degree(27, 'F');
        echo '<br/>';

        echo degree(41, 'C');
        echo '<br/>';
    ?>
</div>