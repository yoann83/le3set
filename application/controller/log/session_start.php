<?php

//démarrage de la session AVANT d'écrire mon code HTML
function debutSession() {
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
        if (empty($_SESSION['prenom'])) {
            $_SESSION['prenom'] = '';
            $_SESSION['nom'] = '';
            $_SESSION['visible'] = 'hide';
            $_SESSION['Admin'] = 'hide';
            $_SESSION['hide'] = 'visible';

        } else {
            $_SESSION['prenom'];
            $_SESSION['nom'];
            $_SESSION['visible'];
            $_SESSION['hide'];
        }
}
