<?php
/*************** add advice user connecté **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le advice_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROUALNT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL REGISTER
require_once 'application/model/DatabaseAdvice.class.php';
$dataAdvice = new DataBaseAdvice();
$advices = $dataAdvice->get_advices();


//ETAPE 4 : AJOUTER UN UTILISATEUR A LA TABLE REGISTER
if (array_key_exists('advice',$_POST)){
    $pseudo      = $_POST['pseudo'];
    $advice      = $_POST['textAdvice'];
    $titleAdvice = $_POST['titleAdvice'];

    $dataAdvice = [
        $pseudo,
        $advice,
        $titleAdvice
    ];

    $dbAdvice = new DataBaseAdvice();
    $success = $dbAdvice->add_advice($dataAdvice);

    header("Refresh:0");

}
