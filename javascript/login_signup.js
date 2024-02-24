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