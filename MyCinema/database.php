<?php
    try {
        $database = new pdo("mysql:host=localhost;dbname=cinema;charset=UTF8", "aurelien", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
?>