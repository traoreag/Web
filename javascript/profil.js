$(document).ready(function(){ 
    // Requête AJAX pour récupérer les commandes
    $.ajax({
    url: 'php/commandes.php', // Adresse de votre script serveur
    method: 'GET', // Méthode HTTP pour récupérer les données
    success: function(response){
    $('#liste-commandes').html(response);
    },
    error: function(xhr, status, error){
    console.error(xhr.responseText);
    }
});

// Requête AJAX pour récupérer les messages de l'utilisateur
    $.ajax({
    url: 'php/messages.php', // Adresse de votre script serveur
    method: 'GET', // Méthode HTTP pour récupérer les données
    success: function(response){
    $('#liste-messages').html(response);
    },
    error: function(xhr, status, error){
    console.error(xhr.responseText);
    }
    });

// Requête AJAX pour récupérer les informations de l'utilisateur
    $.ajax({
    url: 'php/user_info.php', // Adresse de votre script serveur
    method: 'GET', // Méthode HTTP pour récupérer les données
    success: function(response){
    var utilisateur = JSON.parse(response);
    // Mettre à jour les éléments HTML avec les informations de l'utilisateur
    $('#nom').text(utilisateur.nom);
    $('#email').text(utilisateur.email);
    $('#username').text(utilisateur.username);
    $('#pays').text(utilisateur.pays);
    $('#adresse').text(utilisateur.adresse);
    $('#numero').text(utilisateur.numero);
    },
    error: function(xhr, status, error){
    console.error(xhr.responseText);
    }
    });
});