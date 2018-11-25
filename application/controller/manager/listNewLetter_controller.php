<?php
/*************** Liste new letter **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le listNewLetter");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME ET POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL REGISTER
require_once 'application/model/DatabaseRegister.class.php';
$dataRegister = new DatabaseRegister();
$registers = $dataRegister->new_letter();