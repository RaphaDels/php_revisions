"# php_revisions" 

REVISIONS PHP


EX 1    CONTACTS

Créer un tableau PHP contenant une liste de contacts. Voici la liste des contacts : 

    Auguste Fréchette, 30 novembre 1942, 92190 MEUDON, 01.22.88.26.88
    Algernon Duranseau, 2 novembre 1966, 91190 GIF-SUR-YVETTE, 01.80.31.88.75
    Armand Duplessis, 29 juillet 1953, 77380 COMBS-LA-VILLE, 01.07.46.25.64
    Zacharie LaGrande, 27 février 1990, 80090 AMIENS, 03.02.52.82.94
    Aubrey Bourassa, 14 novembre 1982, 33800 BORDEAUX, 05.55.59.61.44

La date doit être stockée dans le tableau sous la forme d'un timestamp.
Nous voulons ce rendu final pour chacun des contacts : 
Auguste Fréchette est né le 30 novembre 1942, il a 75 ans. Il habite à Meudon (92190). Il est joignable au 01 22 88 26 88. 



EX 2    FONCTION CELSIUS/FAHRENHEIT

Créer une fonction permettant de convertir des degrès celsius en farenheit et inversement.
Des messages devront s'afficher en fonction de la température (celle en Celsius :)).

En dessous de 0 : Il fait très froid.
Entre 0 et 14 degrès : C'est le nooord.
Entre 15 et 25 degrès : Il fait bon.
Au dessus de 25 degrès : Il fait trop chaud.

Exemple du code :
    echo degree(27, 'F'); // Affiche "Il fait trop chaud. 27°C équivaut à 80.6°F."
    echo degree(41, 'C'); // Affiche "C'est le nooord. 41°F équivaut à 5°C."

0°C = 32°F / 1°C = 33.8°F / 2°C = 35.6°F / 1°F = -17.2222°C



EX 3    GESTION DES SERIES

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

Créer une page permettant de voir une série en détail. On pourra lire le synopsis à partir de cette page. 



EX 4 BONUS

Nous allons ajouter la gestion de saisons/épisodes par séries.

Créer la table 'season' :
    id
    number INT
    title VARCHAR NULL
    released_at DATE
    show_id -> Relation avec l'id d'une série

Créer la table 'episode' :
    id
    number INT
    title VARCHAR NULL
    released_at DATETIME
    season_id -> Relation avec l'id d'une saison

Créer une page avec un formulaire permettant d'ajouter une saison. Attention, il faudra ajouter un champ select avec le choix de la série.

Créer une page avec un formulaire permettant d'ajouter un épisode. Attention, il faudra ajouter un champ select avec le choix de la saison affiché sous la forme "SERIE - SAISON". Il faudra récupérer les options de ce select de manière dynamique directement dans la BDD.

On pourra voir la liste des saisons et des épisodes directement sur la fiche d'une série.

