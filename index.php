<?php

//define the path of the project root
$index_url = "http://".$_SERVER['SERVER_NAME'] . ":" .$_SERVER['SERVER_PORT'] . $_SERVER['SCRIPT_NAME'];
define('PATH_ROOT', $index_url);

// suppression de index.php pour avoir l'url du projet
define('HOME', str_replace('index.php', '' , $index_url ));

// lien vers les vues
define('VIEW_PATH', HOME. "application/view/" );

// lien vers les controllers
//define('CTRL_PATH', HOME. "application/controller/" );

// selection du bon template
if(array_key_exists("page", $_GET)) {
    $page = $_GET['page'];
    if (file_exists("application/controller/$page" . "_controller" . ".php")) {
        require_once "application/controller/$page" . "_controller" . ".php";
    }

    if (file_exists("application/view/$page.phtml")) {
        // dans le cas ou la page est trouvée
        $template = $page;
    }else{
        // résultat si la page n'existe pas
        $template = 404;
    }
} else {
    // page par défaut
    $template = "home";
}

require_once "application/controller/log/session_start.php";
$userSession = debutSession();

require_once "application/controller/home_controller.php";
require_once "application/view/layout.phtml";