<?php
/*************** home **********************/

//ETAPE 1 : DÉCOMMENTER POUR VOIR LE TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le home_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL PRODUCTS
require_once 'application/model/DatabaseProduct.class.php';
$dataProduct = new DataBaseProduct();
$Products = $dataProduct->get_Products();

