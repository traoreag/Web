<?php
// Connexion à la base de données
$mysqli = new mysqli("192.168.56.10", "admin", "network", "e-commerce");

// Vérifier la connexion
if($mysqli === false){
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

// Requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT nom, email, pays, adresse, numero FROM User WHERE id = ?";

// Préparer la requête
$stmt = $mysqli->prepare($sql);

// Lier les paramètres
$user_id = 123; // Remplacez par l'ID de l'utilisateur
$stmt->bind_param("i", $user_id);

// Exécuter la requête
$stmt->execute();

// Lier les résultats de la requête à des variables
$stmt->bind_result($nom, $email, $pays, $adresse, $numero);

// Créer un tableau associatif pour stocker les informations de l'utilisateur
$utilisateur = array();

// Récupérer les résultats
while($stmt->fetch()){
    $utilisateur['nom'] = $nom;
    $utilisateur['email'] = $email;
    $utilisateur['pays'] = $ville;
    $utilisateur['adresse'] = $adresse;
    $utilisateur['numero'] = $numero;
}

// Convertir le tableau associatif en format JSON
echo json_encode($utilisateur);

// Fermer la connexion et les ressources
$stmt->close();
$mysqli->close();
?>