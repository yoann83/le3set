"use strict";

<!-- redirection à la page d'acceuil -->


//console.log("je suis dans l'erreur 404 !");
setTimeout(function(){
    document.location.href = HOME
}, 10000);

/****** AFFICHAGE DU DECOMPTE EN METHODE innerHtml******/
var compteur = 10;

timer = setInterval(function(){
    if(compteur > 0)
    {
        --compteur;
        document.getElementById("timerPathHome").innerHTML = "<h2> Patientez, vous allez être redirigé à la page d'accueil dans : " + compteur + " secondes</h2>" ;
    }
}, 1000);