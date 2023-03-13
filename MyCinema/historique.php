<?php
// Recherche historique membre
if (isset($_GET["prenom"]) and isset($_GET["nom"]) and !empty($_GET["prenom"]) and !empty($_GET["nom"])) {
    $prenom = $_GET["prenom"];
    $nom = $_GET["nom"];
    $request = $database->prepare('SELECT membre.id_membre FROM membre JOIN fiche_personne ON fiche_personne.id_perso = membre.id_fiche_perso WHERE prenom = ? AND nom = ?');
    $request->execute(array($_GET["prenom"], $_GET["nom"]));
    $data = $request->fetch();
    $id_membre = $data["id_membre"];

    $request->closeCursor();
}

if (isset($_GET["prenom"]) and isset($_GET["nom"]) and !empty($_GET["prenom"]) and !empty($_GET["nom"])) {
    $request = $database->prepare("SELECT titre FROM film JOIN historique_membre ON film.id_film = historique_membre.id_film WHERE id_membre = $id_membre ORDER BY titre");
    $request->execute(array($_GET["prenom"], $_GET["nom"]));

    echo "<h3>" . "Historique des films visionnés :" . "</h3>";

    while ($data = $request->fetch()) {
        echo  "<p>" . $data["titre"] . "</p>";
    }

    echo   "<form method='GET'>
            <input type='hidden' name='prenom' id='historique' value='$prenom'>
            <input type='hidden' name ='nom' value='$nom'>
            <input type='text' placeholder='Ajouter un film dans historique' id='historique' name='historique'> 
            <input type='submit' id='button-historique' value='Ajouter' name='Ajouter'>
            <input class='refresh' type='submit' value='&#x21bb;' name=''></button>

            </form>";

    $request->closeCursor();
}

// Ajouter historique
if (isset($_GET["prenom"]) and isset($_GET["nom"]) and isset($_GET["historique"]) and !empty($_GET["historique"])) {
    $request = $database->prepare("SELECT titre, id_film FROM film WHERE titre = ?");
    $request->execute(array($_GET["historique"]));
    $data = $request->fetch();
    $id_film = $data["id_film"];
    $film = $data["titre"];

    echo $film . " a été ajouté à l'historique<br><br>";

    $request->closeCursor();
}

if (isset($_GET["historique"]) and !empty($_GET["historique"]) and isset($_GET["Ajouter"])) {
    $date = $database->prepare("SELECT NOW()");
    $request = $database->query("INSERT INTO historique_membre (id_membre, id_film, date) VALUES ($id_membre, $id_film, NOW())");
    $_GET["historique"] = 0;
    $request->closeCursor();
}

if (isset($_GET["prenom"]) and isset($_GET["nom"]) and !empty($_GET["prenom"]) and !empty($_GET["nom"])) {
    
    echo   "<br><br><form method='GET'>
            <input type='hidden' name='prenom' id='historique' value='$prenom'>
            <input type='hidden' name ='nom' value='$nom'>
            <input type='text' placeholder='Précisez le film' id='film-avis' name='film'><br><br>
            <textarea id='avis' name='avis' placeholder='Donnez votre avis'></textarea><br>           
            <input type='submit' id='button-avis' value='Envoyer' name='Envoyer'>
            </form>";
}
// Ajouter avis

if  (isset($_GET["prenom"]) AND isset($_GET["nom"]) AND isset($_GET["film"]) AND !empty($_GET["film"])) {   
    $request = $database->prepare("SELECT titre, id_film FROM film WHERE titre = ?");
    $request->execute(array($_GET["film"]));
    $data = $request->fetch();        
    $id_film_avis = $data["id_film"];
    $request->closeCursor();
    }

if (isset($_GET["film"]) AND !empty($_GET["film"]) AND isset($_GET["avis"]) AND !empty($_GET["avis"]) AND isset($_GET["Envoyer"])) {
    $avis = $_GET["avis"];
    $request = $database->query("UPDATE historique_membre SET avis = '$avis' WHERE id_membre = $id_membre AND id_film = $id_film_avis");        
    $request->closeCursor();
    }