<?php

//ETAPE 1 : MISE EN PLACE DES VARIABLES

$dossier = __DIR__."/";
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 300000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.');

//ETAPE 2 : VERIFICATION DE DONNEES SECURISÉ

//Si l'extension n'est pas dans le tableau
if(!in_array($extension, $extensions))
{
    echo "<script type='text/javascript'>document.location.replace('http://restaurantle3set.fr/?page=manage/errorUpload');</script>";
    exit();
}

if($taille>$taille_maxi)
{
    echo "<script type='text/javascript'>document.location.replace('http://restaurantle3set.fr/?page=manager/errorUpload');</script>";
    exit();
}

//j'ai pas d'erreur j'upload le fichier
if(!isset($erreur))
{
    //je formate le nom du fichier ici
    $fichier = strtr($fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

    //si la fonction renvoie TRUE, c'est que ça a fonctionné
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)){
        echo "<script type='text/javascript'>document.location.replace('http://restaurantle3set.fr/?page=manager/validateUpload');</script>";

    }else{
        //sinon, la fonction renvoie FALSE
        echo "<script type='text/javascript'>document.location.replace('http://restaurantle3set.fr/?page=manager/errorUpload');</script>";
        exit();
    }
}
