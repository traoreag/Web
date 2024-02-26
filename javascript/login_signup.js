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
    
    // Vérifier que tous les champs du formulaire de connexion sont remplis
    if (!$('#loginForm')[0].checkValidity()) {
        // Si un champ est vide, empêcher la soumission du formulaire
        alert("Veuillez remplir tous les champs du formulaire de connexion.");
        return;
    }
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
            window.location.href = 'profil.html';
        },
        error: function(xhr, status, error) {
            // Traitement de l'erreur
            console.log(xhr.responseText);
            // Afficher un message d'erreur à l'utilisateur
            if(xhr.status === 400) {
                alert(xhr.responseText); 
            }
        }
    });
});


signup.addEventListener('click', function(event) {
    event.preventDefault(); // Empêcher le formulaire de soumettre normalement
    
    // Vérifier que tous les champs du formulaire d'inscription sont remplis
    //if (!$('#signupForm')[0].checkValidity()) {
        // Si un champ est vide, empêcher la soumission du formulaire
        //alert("Veuillez remplir tous les champs du formulaire d'inscription.");
        //return;
    //}

    // Récupérer les données du formulaire
    var formData = {
        nom: $('input[name=nom]').val(),
        prenom: $('input[name=prenom]').val(),
        new_username: $('input[name=new_username]').val(),
        new_email: $('input[name=new_email]').val(),
        dob: $('input[name=dob]').val(),
        gender: $('select[name=gender]').val(),
        pays_naissance: $('select[name=pays_naissance]').val(),
        adresse: $('input[name=adresse]').val(),
        phone: $('input[name=phone]').val(),
        new_password: $('input[name=new_password]').val(),
        confirm_password: $('input[name=confirm_password]').val()
    };

    // Effectuer la requête AJAX
    $.ajax({
        type: 'POST',
        url: 'php/inscription.php',
        data: formData,
        success: function(response) {
            // Traitement de la réponse en cas de succès
            console.log(response);
            window.location.href = 'profil.html';
        },
        error: function(xhr, status, error) {
            // Traitement de l'erreur
            console.log(xhr.responseText);
            // Afficher un message d'erreur à l'utilisateur
            if(xhr.status === 400) {
                alert(xhr.responseText); 
            }
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
