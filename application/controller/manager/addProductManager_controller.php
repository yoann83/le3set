<?php
/*************** CardManager ajout de menu **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le AddProductsManager.controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL PRODUCTS
require_once 'application/model/DatabaseProduct.class.php';
$dataProduct = new DataBaseProduct();
$Products = $dataProduct->get_Products();


//ETAPE 4 : AJOUTER UN PRODUIT A LA TABLE PRODUCTS
if (array_key_exists('addProduct',$_POST)){
    $titleProduct    = $_POST['titleProduct'];
    $description     = $_POST['description'];
    $priceSingle     = $_POST['priceSingle'];
    $Picture         = $_POST['picture'];

    $dataProduct = [
        $titleProduct,
        $priceSingle,
        $description,
        $picture = $Picture
    ];

    $dbProduct = new DataBaseProduct();
    $success = $dbProduct->add_Product($dataProduct);

    header("Refresh:0");

}