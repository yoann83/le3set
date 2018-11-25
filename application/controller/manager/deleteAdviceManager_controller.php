<?php
/*************** delete advice **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le deleteAdvice_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL ADVICES POUR UNE LECTURE
require_once 'application/model/DatabaseAdvice.class.php';
$dataAdvice = new DataBaseAdvice();
$advices = $dataAdvice->get_advices();


//ETAPE 4 : SUPPRIMER UN AVIS A LA TABLE ADVICES
if (array_key_exists('deleteAdvice',$_POST)){
    $id     =  $_POST['idAdvice'];

    $dataId = [
        $id,
    ];

    $dbAdvice = new DataBaseAdvice();
    $success = $dbAdvice->delete_advice($dataId);

    header("Refresh:0");
}