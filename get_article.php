<?php

include 'core/core.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT Etudiant.*, Article.* FROM Article, Etudiant 
                WHERE Etudiant.id = Article.auteur"; 
                //AND Etudiant.id != $id";

    $result = $mysqli->query($sql) or die($mysqli->error);

    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row["prenom"] . " " . $row["nom"] . "</p>";
        echo "<h3>" . $row["contenu"] . "</h3>";
        echo "<hr>";
        echo "<h3>" . $row["media"] . "</h3>";
        echo "<hr>";
    }
}
?>