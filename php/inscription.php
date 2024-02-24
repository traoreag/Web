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

// Récupérer les données du formulaire d'inscription
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$username = $_POST['username'];
$email = $_POST['email'];
$date = $_POST['dob'];
$gender = $_POST['gender'];
$pays = $_POST['pays'];
$adresse = $_POST['adresse'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Vérifier si le mot de passe et la confirmation sont identiques
if($password !== $confirm_password) {
    echo "Les mots de passe ne correspondent pas";
    exit();
}

// Vérifier si l'utilisateur existe déjà
$query = "SELECT * FROM User WHERE username='$username'";
$result = $mysqli->query($query);
if($result->num_rows > 0) {
    echo "Nom d'utilisateur déjà utilisé, veuillez en choisir un autre";
    exit();
}

// Hasher le mot de passe
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Préparer la requête d'insertion avec des paramètres
$sql = "INSERT INTO User (nom, prenom, username, email, dob, gender, pays, adresse, numero, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssssssssss", $nom, $prenom, $username, $email, $date, $gender, $pays, $adresse, $phone, $hashed_password);
$sql2 = "SELECT * FROM User WHERE email=? AND password=?";
$stmt2 = $mysqli->prepare($sql);
$stmt2->bind_param("ss", $email, $password);

// Exécuter la requête
if ($stmt->execute()) {
    echo "Inscription réussie";
    $stmt2->execute();
    $result = $stmt2->get_result();
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
} else {
    echo "Erreur d'inscription: " . $stmt->error;
}

// Fermer la connexion à la base de données
$stmt->close();
$mysqli->close();
?>
