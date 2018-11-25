<?php
/*************** Edit product **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le editProductManager");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME ET POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL PRODUCTS
require_once 'application/model/DatabaseProduct.class.php';
$http_id = $_GET['id'];

$dataProduct = new DataBaseProduct();
$Product = $dataProduct->get_Product($http_id);

//ETAPE 4 : EDITER UN PRODUIT SELECTIONNER
if (array_key_exists('editProduct',$_POST)){

    $id              = $_POST['editId'];
    $titleProduct    = $_POST['titleProduct'];
    $description     = $_POST['description'];
    $priceSingle     = $_POST['priceSingle'];
    $Picture         = $_POST['picture'];

    $data = [
        $picture = $Picture,
        $titleProduct,
        $description,
        $priceSingle,
        $id = $http_id,
    ];

    $dbProduct = new DataBaseProduct();
    $success = $dbProduct->edit_Product($data);

    header('Location:'.HOME.'?page=manager/operationProductManager');

}