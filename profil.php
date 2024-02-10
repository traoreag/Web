<?php
include 'core/core.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap');
	</style>
    <title>Profil</title>
</head>

<body>
	<div class="">
		<?php include('_header.php') ?>
	</div>
    <!-- Ajouter ci-dessous votre div avec l’id contenuNotifications -->
    <div class="contenuProfile">
        <h1 style="text-align:center">MON PROFIL</h1>
        <img src="img/medias/campus.jpg" height="500" width="100%" />
        <div class="image-circulaire">
            <img src="img/medias/im-profil.jpg" height="200" width="100%" />
        </div>
    </div>
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        <script>
            // déclarer ici votre fonction javascript updateNotifications
            function updateNotifications() {
                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        document.getElementById("contenuNotifications").innerHTML = xhttp.responseText;
                    }
                };
                xhttp.open("POST", "http://192.168.56.80/pwnd/get_notifications.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                //xhttp.send("id=1");
            }
            updateNotifications();
            setInterval(updateNotifications, 10000);
// Mettez à jour les notifications initiales lors du chargement de la page
// en appelant votre fonction updateNotifications
// Mettez en place une boucle pour mettre à jour les notifications toutes les 10 secondes
// ci-dessous (étape 5) #3e3f5e
        </script>
</body>

</html>
