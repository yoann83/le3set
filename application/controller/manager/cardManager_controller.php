<?php
/*************** CardManager accueil **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le CardManager");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME ET POUR LE TEXT DÉROUALNT
require_once 'application/model/DatabaseHome.class.php';

$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : MODIFIER LE TEXT D'ACCUEIL
if (array_key_exists('textAccueil',$_POST)) {
    $title = $_POST['titleHome'];
    $textHome = $_POST['textHome'];

    $dataHome = [
        $title,
        $textHome
    ];

    $dbHome = new DataBaseHome();
    $success = $dbHome->edit_home($dataHome);

    header("Refresh:0");

}

//ETAPE 4 : MODIFIER LE TEXT DÉROULANT
if (array_key_exists('Pop',$_POST)) {
    $pop = $_POST['textPop'];

    $dataPop = [
        $pop
    ];

    $dbHomePop = new DataBaseHome();
    $successPop = $dbHomePop->edit_pop($dataPop);

    header("Refresh:0");

}