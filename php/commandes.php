<?php
// Connexion à la base de données
$mysqli = new mysqli("192.168.56.10", "admin", "network", "e_commerce");

// Vérifier la connexion
if($mysqli === false){
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

// Requête SQL pour récupérer les commandes de l'utilisateur
$sql = "SELECT * FROM Command WHERE proprietaire = ?";

// Préparer la requête
$stmt = $mysqli->prepare($sql);

// Lier les paramètres
$user_id = $_SESSION['user_id']; // Remplacez par l'ID de l'utilisateur

// Préparer la requête
$stmt->bind_param("i", $user_id);

// Exécuter la requête
$stmt->execute();

// Récupérer le résultat
$result = $stmt->get_result();

// Vérifier s'il y a des résultats
if($result->num_rows === 0) {
    echo "Aucune commande pour le moment.";
    exit();
}

// Générer le HTML pour les commandes
$html = '';
while($row = $result->fetch_assoc()){
    $html .= '<p>'.$row['nom'].'</p><p>'.$row['description'].'</p>';
}

// Afficher le HTML
echo $html;

// Fermer la connexion et les ressources
$stmt->close();
$mysqli->close();
?>
