<?php
/*************** header **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le header_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();