<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.1">
    <title>my_cinema</title>
</head>

<body>
    <?php
    require_once("database.php");
    ?>
    <header id="header">   
        <h1 id="titre">My cinema</h1>
    </header>
     <br>
     <br>
     <br>  
    <div class="fieldset">
        <fieldset class="film">
            <form  method="GET">
                <h1 class="titre-form">ESPACE FILM</h1>
                <input type="text" placeholder="Rechercher film" id="field-film" name="titre">
                <input class="submit" type="submit" value="Rechecher">
                <select class="select-genre" name="genre" id="genre" onchange="this.form.submit()">
                    <option value="">GENRE</option>
                    <?php
                    $genre = $database->query('SELECT UPPER(nom) AS nom FROM genre ORDER BY nom');
                    foreach ($genre as $key => $value) {
                        $option_genre = htmlspecialchars($value['nom']);

                        echo "<option value='$option_genre'>$option_genre</option>";
                    }
                    ?>
                </select>
                <select class="select-distributeur" name="distributeur" id="distributeur" onchange="this.form.submit()">
                    <option value="">DISTRIBUTEUR</option>
                    <?php
                    $distrib = $database->query("SELECT UPPER(nom) AS nom FROM distrib ORDER BY nom");
                    foreach ($distrib as $key => $value) {
                        $option_distrib = htmlspecialchars($value['nom']);
                        echo "<option value='$option_distrib'>$option_distrib</option>";
                    }
                    ?>
                </select>
            <input id="date" type="date" id="date" name="date">
            </form>
            <?php
            // Recherche de film par nom, genre et distributeur
            require_once("film.php");
            ?>
        </fieldset>
        <br>
        <br>
        <fieldset class="membre" >
            <form method="GET">
                <h1 class="titre-form">ESPACE MEMBRE</h1>
                <input class="field-membre" type="text" placeholder="Prénom" id="membre" name="prenom">
                <input class="field-membre" type="text" placeholder="Nom" id="membre" name="nom">
                <input class="submit" type="submit" value="Rechecher">
                <input class="refresh" type="button" value="&#x21bb;" onClick="history.go(0)"></button>
            </form>
            <?php
            // Recherche de membre
            require_once("membre.php");
            // Recherche historique membre
            require_once("historique.php");
            ?>
        </fieldset>
        <br>
        <br>
        <fieldset class="abonnement">
            <form method="POST">
                <h1 class="titre-form">GESTION ABONNEMENT</h1>
                <input class="field-abonnement" type="text" placeholder="Prénom" id="membre_abo" name="prenom">
                <input class="field-abonnement" type="text" placeholder="Nom" id="membre_abo" name="nom">
                <input class="submit" type="submit" value="VIP" name="1">
                <input class="submit" type="submit" value="GOLD" name="2">
                <input class="submit" type="submit" value="CLASSIC" name="3">
                <input class="submit" type="submit" value="PASS DAY" name="4">
                <input class="submit" type="submit" value="SUPPRIMER" name="0">
            </form>
            <?php
            require_once("abonnement.php");
            ?>                  
        </fieldset>
    </div>
    </fieldset>







    <!-- phpinfo(); -->

</body>

</html>