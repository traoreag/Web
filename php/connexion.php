<?php
// Démarrer la session
session_start();

$_SESSION['user_id'] = -1;

// Connexion à la base de données
$mysqli = new mysqli("192.168.56.10", "admin", "network", "e_commerce");

// Vérifier la connexion
if($mysqli->connect_errno) {
    echo "Echec de connexion à la base de données: " . $mysqli->connect_error;
    exit();
}

// Récupérer les données du formulaire de connexion
$email = $mysqli->real_escape_string($_POST['email']);
$password = $mysqli->real_escape_string($_POST['password']);

http_response_code(200);

// Requête préparée pour vérifier si l'utilisateur existe dans la base de données
$sql = "SELECT * FROM User WHERE email=? AND password=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($result->num_rows > 0) {
    // Utilisateur trouvé, authentification réussie
    echo "Connexion réussie";
    $_SESSION['user_id'] = $row['id'];
} else {
    http_response_code(400);
    // Aucun utilisateur trouvé, authentification échouée
    echo "Identifiants invalides";
}

// Fermer les ressources
$stmt->close();
$mysqli->close();
?>
