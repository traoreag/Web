<?php

include 'core/core.php';

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $sql = "SELECT Etudiant.*, Notification.* 
                FROM Notification, Etudiant
                    WHERE Etudiant.id = Notification.etudiantEmetteur AND Etudiant.id IN (SELECT etudiantEmetteur FROM Notification WHERE etudiantRecepteur = $id
                        AND statutLecture = 'non'
                        AND statutSuppression = 'non')";

    $result = $mysqli->query($sql) or die($mysqli->error);

    while ($row = $result->fetch_assoc()) {
        echo "<h3>" . $row["type"] . "</h3>";
        echo "<p>" . $row["prenom"] . " " . $row["nom"] . "</p>";
        echo "<hr>";
    }
}
?>