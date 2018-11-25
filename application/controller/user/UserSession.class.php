<?php

//ouverture d'une session si elle n'existe pas
function SessionStart() {
    if (session_status() != PHP_SESSION_ACTIVE)
        session_start();
    if (empty($_SESSION['prenom']))
        echo $_SESSION['prenom'] = '';
    else
        echo $_SESSION['prenom'];
}
