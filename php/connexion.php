<?php
// Connexion à la base de données
$mysqli = new mysqli("192.168.56.10", "admin", "network", "e_commerce");

// Vérifier la connexion
if($mysqli === false){
    die("Erreur de connexion à la base de données: " . $mysqli->connect_error);
}

// Récupérer les données du formulaire de connexion
$email = $_POST['email'];
$password = $_POST['password'];

// Requête pour vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT * FROM User WHERE email='$email' AND mot_de_passe='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Utilisateur trouvé, authentification réussie
    echo "Connexion réussie";
} else {
    // Aucun utilisateur trouvé, authentification échouée
    echo "Identifiants invalides";
}

$conn->close();
?>
