<?php
session_start();
// Connexion à la base de données
$mysqli = new mysqli("192.168.56.10", "admin", "network", "e_commerce");

// Vérifier la connexion
if($mysqli->connect_errno) {
    echo "Echec de connexion à la base de données: " . $mysqli->connect_error;
    exit();
}

// Requête SQL pour récupérer les messages de l'utilisateur
$sql = "SELECT * FROM Message WHERE proprietaire = ?";

// Préparer la requête
$stmt = $mysqli->prepare($sql);

// Vérifier si la préparation de la requête a échoué
if(!$stmt) {
    echo "Echec de la préparation de la requête: " . $mysqli->error;
    exit();
}

// Lier les paramètres
$user_id = $_SESSION['user_id']; // Remplacez par l'ID de l'utilisateur

// Préparer la requête
$stmt->bind_param("i", $user_id);

// Exécuter la requête
if(!$stmt->execute()) {
    echo "Echec de l'exécution de la requête: " . $stmt->error;
    exit();
}

// Résultat de la requête
$result = $stmt->get_result();

// Vérifier s'il y a des résultats
if($result->num_rows === 0) {
    echo "Aucune commande pour le moment.";
    exit();
}


while($row = $result->fetch_assoc()){
    $html .= '<p>'.$row['emetteur'].'</p><p>'.$row['contenu'].'</p>';
}

// Afficher le HTML
echo $html;

// Fermer la connexion et les ressources
$stmt->close();
$mysqli->close();
?>
