"use strict";


/***************************************************************************************************
 ******************************************* DONNEES ************************************************
 ***************************************************************************************************/
var today = new Date();
var weekdays = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
var month = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Semptembre', 'Octobre', 'Novembre', 'Décembre'];
var nb_mois = today.getDate();
var jours = weekdays[today.getDay()];
var mois = month[today.getMonth()];
var annees = today.getFullYear();

// TEXTE DEROULANT
var timer = setInterval(myTimer, 4000);
var larg;
var marge = 5;
var end;
var blocDefil;

/**************************************************************************************************
 ****************************************** FONCTIONS **********************************************
 **************************************************************************************************/

// DATE
function myTimer() {
    let datelocal = new Date();
    let time;
    time = datelocal.toLocaleTimeString();
    document.getElementById("heure").innerHTML = time;
}


//TEXTE DEROULANT
function myStopFunction() {
    clearInterval(timer);
}

function myPlayFunction() {
    timer = setInterval("defile(end)");
}

function defile(fin) {
    marge = marge + 0.1;
    blocDefil.style.marginLeft = marge + "px";

    if(marge >= fin) {
        clearInterval(timer);
        if(!(marge >= larg - blocDefil.offsetLeft)) {
            marge = 0;
            timer = setInterval("defile(end)");
        } else {
            marge = 0;
            timer = setInterval("defile(end)");
        }
    }
}

function initDefile() {
    blocDefil = document.getElementById("text_pop");

    if (document.body) {
        larg = 1700;
    }else {
        larg = 1700;
    }
    end = larg - blocDefil.offsetWidth;
    timer = setInterval("defile(end)");
}

//CACHER OU AFFICHER UNE DIV AU CLICK
function showHide(etat)
{
    switch (etat)
    {
        case 'box_hidden':
            //console.log(etat);
            document.getElementById('box_hidden').classList.toggle('hide');
            break;
        case 'box_hidden2':
            //console.log(etat);
            document.getElementById('box_hidden2').classList.toggle('hide');
            break;
    }
}


//CACHER OU AFFICHER UNE DIV AVEC UN BOUTON RADIO
function radioEvent(etat){
    document.getElementById('box_hidden').style.display = etat;
}

/**************************************************************************************************
 ****************************************** CODE ***************************************************
 **************************************************************************************************/
//AFFICHAGE DE L'HEURE
document.write("<p>" + jours + " " + nb_mois + " " + mois + " " + annees + " : </p>");

