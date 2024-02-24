<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion et Inscription</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 30px;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="submit"],
        select {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        
        input[type="date"]{
            width: auto;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        select {
            width: auto;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #f9f9f9;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="#333333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
            background-repeat: no-repeat;
            background-position: calc(100% - 15px) center;
        }


        p {
            text-align: center;
            margin-top: 20px;
            color: #666666;
        }

        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
    <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="loginForm" action="#" method="post">
            <h2>Connexion</h2>
            <input type="email" name="email" placeholder="E-mail" autocomplete="email" required>
            <input type="password" name="password" placeholder="mot de passe" autocomplete="new-password" required>
            <input type="submit" id="login" value="Se connecter">
            <p>Pas de compte? <a href="#" id="toggleLinkSignup">Inscrivez-vous ici</a>.</p>
        </form>
        <form id="signupForm" action="#" method="post" style="display: none;">
            <h2>Inscription</h2>
            <input type="text" name="nom" placeholder="NOM" autocomplete="family-name" required>
            <input type="text" name="prenom" placeholder="Prénom" autocomplete="given-name" required>
            <input type="text" name="new_username" placeholder="nom d'utilisateur" autocomplete="username" required>
            <input type="email" name="new_email" placeholder="E-mail" autocomplete="email" required>
            <input type="date" id="date" name="dob" value="2000-01-01" min="1900-01-01" max="2024-01-01" placeholder="Date de naissance" autocomplete="off" required>
            <select name="gender" required>
                <option value="" disabled selected>Genre</option>
                <option value="male">Homme</option>
                <option value="female">Femme</option>
                <option value="other">Autre</option>
            </select>
            <select id="pays_naissance">
                <option value="" disabled selected>Pays de naissance</option>
            </select>
            <input type="text" name="adresse" placeholder="Votre Adresse" autocomplete="address-line1" required>
            <input type="tel" name="phone" placeholder="Numéro de téléphone" autocomplete="tel" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" autocomplete="new-password" required>
            <input type="password" name="Confirm_password" placeholder="Comfirmez votre mot de passe" autocomplete="new-password" required>
            <input type="submit" id="signup" value="S'inscrire">
            <p>Déjà un compte? <a href='#' id='toggleLinkLogin'>Connectez-vous ici</a>.</p>
        </form>
    </div>

    <script>
        var toggleLinkSignup = document.getElementById('toggleLinkSignup');
        var toggleLinkLogin = document.getElementById('toggleLinkLogin');
        var login = document.getElementById('login');
        var signup = document.getElementById('signup');

        toggleLinkSignup.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de changer de page
            var loginForm = document.getElementById('loginForm');
            var signupForm = document.getElementById('signupForm');

            loginForm.style.display = 'none';
            signupForm.style.display = 'block';
        });

        toggleLinkLogin.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de changer de page
            var loginForm = document.getElementById('loginForm');
            var signupForm = document.getElementById('signupForm');

            signupForm.style.display = 'none';
            loginForm.style.display = 'block';
        });

        login.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le formulaire de soumettre normalement

            // Récupérer les données du formulaire
            var formData = {
                email: $('input[name=email]').val(),
                password: $('input[name=password]').val()
            };

            // Effectuer la requête AJAX
            $.ajax({
                type: 'POST',
                url: 'php/connexion.php',
                data: formData,
                success: function(response) {
                    // Traitement de la réponse en cas de succès
                    console.log(response);
                    // Rediriger l'utilisateur vers la page profil si la connexion est réussie
                    window.location.href = 'profil.html';
                },
                error: function(xhr, status, error) {
                    // Traitement de l'erreur
                    console.log(xhr.responseText);
                    // Afficher un message d'erreur à l'utilisateur
                }
            });
        });


        signup.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le formulaire de soumettre normalement

            // Récupérer les données du formulaire
            var formData = {
                nom: $('input[name=nom]').val(),
                prenom: $('input[name=prenom]').val(),
                username: $('input[name=new_username]').val(),
                email: $('input[name=new_email]').val(),
                date: $('input[name=dob]').val(),
                gender: $('select[name=gender]').val(),
                pays: $('select[name=pays_naissance]').val(),
                adresse: $('input[name=adresse]').val(),
                phone: $('input[name=phone]').val(),
                password: $('input[name=new_password]').val(),
                confirm_password: $('input[name=Confirm_password]').val()
            };

            // Effectuer la requête AJAX
            $.ajax({
                type: 'POST',
                url: 'php/inscription.php',
                data: formData,
                success: function(response) {
                    // Traitement de la réponse en cas de succès
                    console.log(response);
                    // Rediriger l'utilisateur vers la page profil si l'inscription est réussie
                    window.location.href = 'profil.html';
                },
                error: function(xhr, status, error) {
                    // Traitement de l'erreur
                    console.log(xhr.responseText);
                    // Afficher un message d'erreur à l'utilisateur
                }
            });
        });


        // Fonction pour charger et traiter le fichier CSV
        function chargerCSV(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        callback(xhr.responseText);
                    } else {
                        console.error("Erreur de chargement du fichier CSV : " + xhr.status);
                    }
                }
            };
            xhr.open("GET", url, true);
            xhr.send();
        }

        // Fonction pour extraire les valeurs de la 3e colonne du CSV
        function extrairePays(csvData) {
            var lignes = csvData.split("\n");
            var valeurs = [];
            var select = document.getElementById("pays_naissance");

            // Parcourir les lignes du CSV
            for (var i = 0; i < lignes.length; i++) {
                var colonnes = lignes[i].split(";");

                if (colonnes.length >= 5 && colonnes[4]) {
                    var valeur = colonnes[4].trim();
                    if (valeur !== "") {
                        valeurs.push(valeur); // Stocker la valeur dans le tableau
                    }
                }
            }

            // Trier les valeurs par ordre alphabétique
            valeurs.sort();

            // Ajouter les valeurs triées dans le select
            for (var j = 0; j < valeurs.length; j++) {
                var option = document.createElement("option");
                option.value = valeurs[j];
                option.textContent = valeurs[j];
                select.appendChild(option);
            }
        }
        // Appeler la fonction pour charger et traiter le fichier CSV
        chargerCSV("pays.csv", extrairePays);
        
    </script>
</body>
</html>
