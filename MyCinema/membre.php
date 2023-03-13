<?php
// Recherche de membre
if (isset($_GET["prenom"]) AND isset($_GET["nom"]) AND !empty($_GET["prenom"]) AND !empty($_GET["nom"])) {
    $request = $database->prepare('SELECT UPPER(fiche_personne.nom) AS nom_fiche, UPPER(fiche_personne.prenom) AS prenom, membre.*, UPPER(abonnement.nom) AS nom_abo FROM membre JOIN fiche_personne ON fiche_personne.id_perso = membre.id_fiche_perso JOIN abonnement ON membre.id_abo = abonnement.id_abo WHERE prenom = ? AND fiche_personne.nom  = ? ORDER BY fiche_personne.nom');        
    $request->execute(array($_GET["prenom"], $_GET["nom"]));

    while ($data = $request->fetch()) {
        echo "<p>" . "<h1>" . $data["prenom"] . " " . $data["nom_fiche"] . "<br>" . "Abonnement : " . " " . $data["nom_abo"] . "</h1>" . "</p>";
    }
    $request->closeCursor();
}
elseif (isset($_GET["prenom"]) AND !empty($_GET["prenom"])) {
    $request = $database->prepare('SELECT UPPER(fiche_personne.nom) AS nom_fiche, UPPER(fiche_personne.prenom) AS prenom, membre.*, UPPER(abonnement.nom) AS nom_abo FROM membre JOIN fiche_personne ON fiche_personne.id_perso = membre.id_fiche_perso JOIN abonnement ON membre.id_abo = abonnement.id_abo WHERE prenom = ? ORDER BY fiche_personne.nom');
    $request->execute(array($_GET["prenom"]));

    while ($data = $request->fetch()) {
        echo "<p>" . "<strong>" . "<h2>" . $data["prenom"] . " " . $data["nom_fiche"] . " " . "<br>" . "Abonnement : " . " " . $data["nom_abo"] . "</strong>" . "</p>";
    }
    $request->closeCursor();
}
elseif (isset($_GET["nom"]) AND !empty($_GET["nom"])) {
    $request = $database->prepare('SELECT UPPER(fiche_personne.nom) AS nom_fiche, UPPER(fiche_personne.prenom) AS prenom, membre.*, UPPER(abonnement.nom) AS nom_abo FROM membre JOIN fiche_personne ON fiche_personne.id_perso = membre.id_fiche_perso JOIN abonnement ON membre.id_abo = abonnement.id_abo WHERE fiche_personne.nom = ? ORDER BY fiche_personne.nom');
    $request->execute(array($_GET["nom"]));

    while ($data = $request->fetch()) {
        echo "<p>" . "<strong>" . "<h2>" . $data["prenom"] . " " . $data["nom_fiche"] . " " . "<br>" . "Abonnement : " . " " . $data["nom_abo"] . "</strong>" . "</p>";
    }
    $request->closeCursor();
}

?>