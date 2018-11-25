<?php
/*************** delete product **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le deleteProduct_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL PRODUCTS
require_once 'application/model/DatabaseProduct.class.php';
$dataProduct = new DataBaseProduct();
$Products = $dataProduct->get_Products();


//ETAPE 4 : SUPPRIMER UN AVIS A LA TABLE PRODUCTS
if (array_key_exists('deleteProduct',$_POST)){
    $id     =  $_POST['idProduct'];

    $dataId = [
        $id,
    ];

    $dbAdvice = new DataBaseProduct();
    $success = $dbAdvice->delete_Product($dataId);

    header("Refresh:0");
}
