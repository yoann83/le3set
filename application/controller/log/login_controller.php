<?php
/*************** log **********************/

//ETAPE 1 : DÉCOMMENTER POUR VOIR LE TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le login_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROUALNT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : RECUPERATION DES DONNES EN POST DU FORMULAIRE DE CONNEXION
if (array_key_exists('login',$_POST)){
    $email         = $_POST[ strtolower( trim('email') ) ];
    $password      = $_POST[ trim('password') ];

    $dataLog = [
        $email,
        $password = MD5($password)
    ];


//ETAPE 4 : CREATION D'UN TABLEAU GET POUR L'AFFICHAGE DES ERREURS
    $_GET_error=[];


    //Email
    $regexEmail = '/^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    $testChampEmail = preg_match_all($regexEmail, $email,$out);
    if (!$testChampEmail) {
        //echo ("- ERROR la chaine '" . $email . "' est invalide <br/>"."\n" );
        $_GET_error[0] = "\"" . $email. "\"" . " n'est pas valide <div>" . "\n" . "Aide : le caractère '@' et le point '.' est requis </div>" . "\n";
        $resultEmail = false;
    } else {
        //echo ("- la chaine '" . $email . "' est valide <br/>"."\n" );
        $resultEmail = true;
    }

    //Password
    $regexNumber        = '/[0123456789]/';
    $testChampNumber  = preg_match_all($regexNumber , $_POST[ trim('password') ],$out);
    $regexLowercase     = '/[a-z]/';
    $testChampLowercase   = preg_match_all($regexLowercase  , $_POST[ trim('password') ],$out);
    $regexUppercase     = '/[A-Z]/';
    $testChampUppercase   = preg_match_all($regexUppercase  , $_POST[ trim('password') ],$out);
    if (!$testChampNumber || !$testChampLowercase || !$testChampUppercase ) {
        //echo ("- ERROR la chaine '" . $_POST[ trim('password') ] . "' est invalide <br/>"."\n" );
        $_GET_error[1] = "\"" . "le mot de passe". "\"" . " n'est pas valide <div>" . "\n" . "Aide : il faut une majuscle, une minuscule et un chiffre </div>" . "\n";
        $resultPassword = false;
    } else {
        //echo ("- la chaine '" . $_POST[ trim('password') ] . "' est valide <br/>"."\n" );
        $resultPassword = true;
    }


// ETAPE 5 : TEST DE TOUT LES RESULTATS DES CONDITIONS

    if($resultEmail & $resultPassword ) {
        //echo ("- Le formulaire est bon <br/>"."\n" );


// ETAPE 6 : TEST DANS LA BASE DE DONNÉES "LOGINS"
        //inclusion des models de logins
        require_once 'application/model/DatabaseLogin.class.php';
        $dataLogin = new DataBaseLogin();
        $data_users = $dataLogin->get_login($email);
        $User_password = $dataLogin->get_password($password);
        $User_mail = $dataLogin->get_mail($email);
        //var_dump($data_users);
        //var_dump($User_mail, $User_password);

        //création du user
        $userMail       = $data_users['email'];
        $userFirstName  = $data_users['firstName'];
        $userLastName   = $data_users['lastName'];
        //var_dump($userFirstName, $userLastName);

        if ($User_mail and $User_password){
            //echo "le mail et le passeword sont valident";

            //démarrage de la session AVANT d'écrire mon code HTML
            if (session_status() != PHP_SESSION_ACTIVE)
                session_start();
                $admin = 'martinezyoann83@gmail.com';//mail admin à changer si différent + base de donnée + register_controller

            if ($email != $admin){
                //création des variables de session dans $_SESSION
                $_SESSION['mail'] = $userMail;
                $_SESSION['prenom'] = $userFirstName;
                $_SESSION['nom'] = $userLastName;
                $_SESSION['visible'] = 'visible';
                $_SESSION['Admin'] = 'hide';
                $_SESSION['hide'] = 'hide';
                //echo "utilisateur connecté";

                header('location: index.php');

            } else {
                $_SESSION['mail'] = $userMail;
                $_SESSION['nom'] = $userLastName;
                $_SESSION['prenom'] = $userFirstName;
                $_SESSION['visible'] = 'visible';
                $_SESSION['Admin'] = 'visible';
                $_SESSION['hide'] = 'hide';
                //echo "admin connecté";

                header('location: index.php');
            }

        } else {
            //echo "le mail exist pas";
            $_GET_error[2] = "\"" . $email . "\"" . " n'existe pas ! <div>" . "\n" . "Aide : Enregistrez-vous pour une première connexion </div>" . "\n";
            $_GET_error[3] = "Mot de passe invalide ! <div>" . "\n" . "Aide : Enregistrez-vous pour une première connexion </div>" . "\n";
        }

    } else {
        //echo ("- Le formulaire n'est  pas testé <br/>"."\n" );
    }
}
