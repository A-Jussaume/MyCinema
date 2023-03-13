<?php
// Recherche de films par "Nom"
if (isset($_GET["titre"]) AND !empty($_GET["titre"])) {
    $titre = htmlspecialchars($_GET["titre"]);
    $request = $database->prepare('SELECT * FROM film WHERE titre LIKE "%' . $titre . '%" ORDER BY titre');
    $request->execute(array($_GET["titre"]));
    echo "<h1>" . "Résultats pour" . " " . "$titre" . "</h1>";

    while ($data = $request->fetch()) {
        echo "<p>" . $data["titre"] . "</p>";
    }
    $request->closeCursor();
}
?>
<?php
// Recherche de films par "Genre"
if (isset($_GET["genre"]))
{
    $genre = $_GET["genre"];
    $request = $database->prepare('SELECT titre FROM film INNER JOIN genre ON film.id_genre = genre.id_genre WHERE genre.nom = ? ORDER BY titre');
    $request->execute(array($_GET["genre"]));
    echo "<h1>" . $genre . "</h1>";

    while ($data = $request->fetch()) {
        echo "<p>" . $data["titre"] . "</p>";
    }
    $request->closeCursor();   
}
?>
<?php
// Recherche de films par "Distributeur"
if (isset($_GET["distributeur"])) 
{
    $distributeur = $_GET["distributeur"];
    $request = $database->prepare('SELECT titre FROM film INNER JOIN distrib ON film.id_distrib = distrib.id_distrib WHERE distrib.nom = ? ORDER BY titre');
    $request->execute(array($_GET["distributeur"]));
    echo "<h1>" . $distributeur . "</h1>";

    while ($data = $request->fetch()) {
        echo "<p>" . $data["titre"] . "</p>";
    }
    $request->closeCursor();
}
?>

<?php
// Recherche de films par "Date"
if (isset($_GET["date"]) AND !empty($_GET["date"])) 
{
    $date = $_GET["date"];
    $request = $database->prepare('SELECT titre FROM film  WHERE date_debut_affiche = ? ORDER BY titre');
    $request->execute(array($_GET["date"]));
    echo "<h1>" . "DATE DE PROJECTION " . $date . "</h1>";

    while ($data = $request->fetch()) {
        echo "<p>" . $data["titre"] . "</p>";
    }
    $request->closeCursor();
}
?>