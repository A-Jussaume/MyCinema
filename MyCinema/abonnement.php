<?php
if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->prepare('SELECT membre.id_membre, UPPER(fiche_personne.nom) AS nom, UPPER(fiche_personne.prenom) AS prenom FROM membre JOIN fiche_personne ON fiche_personne.id_perso = membre.id_fiche_perso WHERE prenom = ? AND nom = ?');        
    $request->execute(array($_POST["prenom"], $_POST["nom"]));
    $data = $request->fetch();
    $prenom = $data["prenom"];
    $nom = $data["nom"]; 
    $id_membre = $data["id_membre"];
    $request->closeCursor();
}

if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND ISSET($_POST["1"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->query("UPDATE membre SET id_abo = 1, date_abo = NOW() WHERE id_membre = $id_membre"); 
    
    echo "<p>" . "<strong>" . "<h1>" . $prenom . " " . $nom . " est désormais un membre " . "VIP" . "</p>";
    
    $request->closeCursor();
}

if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND ISSET($_POST["2"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->query("UPDATE membre SET id_abo = 2, date_abo = NOW()  WHERE id_membre = $id_membre"); 
    
    echo "<p>" . "<strong>" . "<h1>" . $prenom . " " . $nom . " est désormais un membre " . "GOLD" . "</p>";

    $request->closeCursor();
}

if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND ISSET($_POST["3"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->query("UPDATE membre SET id_abo = 3, date_abo = NOW() WHERE id_membre = $id_membre");  
    
    echo "<p>" . "<strong>" . "<h1>" . $prenom . " " . $nom . " est désormais un membre " . "CLASSIC" . "</p>";

    $request->closeCursor();
}

if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND ISSET($_POST["4"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->query("UPDATE membre SET id_abo = 4, date_abo = NOW() WHERE id_membre = $id_membre");
    
    echo "<p>" . "<strong>" . "<h1>" . "PASS DAY valable une journée pour le membre " . $prenom . " " .  $nom . "</p>";

    $request->closeCursor();
}

if (isset($_POST["prenom"]) AND isset($_POST["nom"]) AND ISSET($_POST["0"]) AND !empty($_POST["prenom"]) AND !empty($_POST["nom"])) {
    $request = $database->query("UPDATE membre SET id_abo = 0, date_abo = NOW() WHERE id_membre = $id_membre");
    
    echo "<p>" . "<strong>" . "<h1>" . "Abonnement supprimé pour le membre " . $prenom . " " .  $nom . "</p>";

    $request->closeCursor();
}
?>