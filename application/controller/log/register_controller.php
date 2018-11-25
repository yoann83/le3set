<?php
/******************************************************************************************
*************************************** register ******************************************
******************************************************************************************/


//ETAPE 1 : DÉCOMMENTER POUR VOIR LE TEST DE MON CONTROLLER SUR MA VUE
    /*$test = ("je suis dans le register_controller");
    var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROUALNT
    require_once 'application/model/DatabaseHome.class.php';
    $dataHome = new DataBaseHome();
    $Homes = $dataHome->get_homes();


//ETAPE 3 : INCLUSION DU MODEL REGISTER
    require_once 'application/model/DatabaseRegister.class.php';
    $dataRegister = new DatabaseRegister();
    $register = $dataRegister->get_registers();

//ETAPE 4 : INCLUSION DU MODEL LOGIN
    require_once 'application/model/DatabaseLogin.class.php';
    $dataLogin = new DataBaseLogin();
    $login = $dataLogin->get_logins();

//ETAPE 5 : AJOUTER UN UTILISATEUR A LA TABLE REGISTER
if (array_key_exists('register_user',$_POST)){
    $title         = $_POST[ trim('title') ];
    $firstName     = $_POST[ trim('firstName') ];
    $lastName      = $_POST[ trim('lastName' ) ];
    $email         = $_POST[ strtolower( trim('email') ) ];
    $password      = $_POST[ trim('password') ];
    $confPassword  = $_POST[ trim('confPassword') ];
    $adressLine1   = $_POST[ trim('adressLine1') ];
    $adressLine2   = $_POST[ trim('adressLine2') ];
    $city          = $_POST[ trim('city') ];
    $zipCode       = $_POST[ 'zipCode'];
    $phoneNumber   = $_POST[ 'phoneNumber' ];
    $phoneNumber2  = $_POST[ 'phoneNumber2' ];
    $newLetter     = $_POST[ 'newLetter' ];

    //base de donnée pour la table register
    $dataRegister = [
        $title,
        $firstName,
        $lastName,
        $email,
        $password = MD5($password),
        $adressLine1,
        $adressLine2,
        $city,
        $zipCode,
        $phoneNumber,
        $phoneNumber2,
        $newLetter
    ];

    //base de donnée pour la table login
    $dataLogin =[
        $firstName,
        $lastName,
        $email,
        $password
    ];

//ETAPE 6 : CREATION D'UN TABLEAU GET POUR L'AFFICHAGE DES ERREURS
    $_GET_error=[];


//ETAPE 7 : TEST DES CHAMPS DE SAISIE
    //First_name
    $regexFirstName = '/[0123456789@]/';
    $testChampFirstName = preg_match_all($regexFirstName, $firstName,$out);
    if ($testChampFirstName){
        //echo ("- ERROR la chaine '" . $firstName . "' est invalide <br/>"."\n" );
        $_GET_error[0] = "\"" . $firstName. "\"" . " n'est pas valide <div>" . "\n" . "Aide : lettres uniquement </div>" . "\n";
        $resultFirstName = false;
    } else {
        //echo ("- la chaine '" . $firstName . "' est valide <br/>"."\n" );
        $resultFirstName = true;
    }

    //Last_name
    $regexLastName = '/[0123456789@]/';
    $testChampLastName = preg_match_all($regexLastName, $lastName,$out);
    if ($testChampLastName) {
        //echo ("- ERROR la chaine '" . $lastName . "' est invalide <br/>"."\n" );
        $_GET_error[1] = "\"" . $lastName. "\"" . " n'est pas valide <div>" . "\n" . "Aide : lettres uniquement </div>" . "\n";
        $resultLastName = false;
    } else {
        //echo ("- la chaine '" . $lastName . "' est valide <br/>"."\n" );
        $resultLastName = true;
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
        $_GET_error[2] = "\"" . "le mot de passe". "\"" . " n'est pas valide <div>" . "\n" . "Aide : il faut une majuscle, une minuscule et un chiffre </div>" . "\n";
        $resultPassword = false;
    } else {
        //echo ("- la chaine '" . $_POST[ trim('password') ] . "' est valide <br/>"."\n" );
        $resultPassword = true;
    }


    //Confirmation Password
    if ($_POST[ trim('password')] == $_POST[ trim('confPassword') ]){
        //echo ("- la chaine '" . $_POST[ trim('confPassword') ] . "' est confirmé <br/>"."\n" );
        $resultConfPassword = true;
    }else{
        //echo ("- ERROR la chaine '" . $_POST[ trim('confPassword') ] . "' est pas confirmé <br/>"."\n" );
        $_GET_error[3] = "\"" . "les mots de passe". "\"" . " ne correspondent pas <div>" . "\n" . "Aide : Même mot de passe qu'au dessus. </div>" . "\n";
        $resultConfPassword = false;
    }

    //Email
    $regexEmail = '/^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    $testChampEmail = preg_match_all($regexEmail, $email,$out);
    if (!$testChampEmail) {
        //echo ("- ERROR la chaine '" . $email . "' est invalide <br/>"."\n" );
        $_GET_error[4] = "\"" . $email. "\"" . " n'est pas valide <div>" . "\n" . "Aide : le caractère '@' et le point '.' est requis </div>" . "\n";
        $resultEmail = false;
    } else {
        //echo ("- la chaine '" . $email . "' est valide <br/>"."\n" );
        $resultEmail = true;
    }

    //ZipCode
    $regexZipCode = '/^[0-9]{5,5}$/';
    $testChampZipCode = preg_match_all($regexZipCode, $zipCode,$out);
    if (!$testChampZipCode) {
        //echo ("- ERROR la chaine '" . $zipCode . "' est invalide <br/>"."\n" );
        $_GET_error[5] = "\"" . $zipCode. "\"" . " n'est pas valide <div>" . "\n" . "Aide : Contient 5 chiffres </div>" . "\n";
        $resultZipCode = false;
    } else {
        //echo ("- la chaine '" . $zipCode . "' est valide <br/>"."\n" );
        $resultZipCode = true;
    }

    //PhoneNumberFixe
    $regexPhoneNumberFixe = '/^[0-9]{10,10}$/';
    $testChampPhoneNumberFixe = preg_match_all($regexPhoneNumberFixe, $phoneNumber,$out);

    if ($phoneNumber == null or empty($phoneNumber)){
        //echo ("- la chaine '" . $phoneNumber . "' est valide <br/>"."\n" );
        $resultPhoneNumberFixe = true;
    } else {
        if (!$testChampPhoneNumberFixe){
            //echo ("- ERROR la chaine '" . $phoneNumber . "' est invalide <br/>"."\n" );
            $_GET_error[6] = "\"" . $phoneNumber. "\"" . " n'est pas valide <div>" . "\n" . "Aide : Contient 10 chiffres </div>" . "\n";
            $resultPhoneNumberFixe = false;
        } else {
            //echo ("- la chaine '" . $phoneNumber . "' est valide <br/>"."\n" );
            $resultPhoneNumberFixe = true;
        }
    }

    //PhoneNumberPortable
    $regexPhoneNumberPortable = '/^06|07[0-9]{8}$/';
    $testChampPhoneNumberPortable = preg_match_all($regexPhoneNumberPortable, $phoneNumber2,$out);

    if ($phoneNumber2 == null or empty($phoneNumber2)){
        //echo ("- la chaine '" . $phoneNumber . "' est valide <br/>"."\n" );
        $resultPhoneNumberPortable = true;
    } else {
        if (!$testChampPhoneNumberPortable){
            //echo ("- ERROR la chaine '" . $phoneNumber . "' est invalide <br/>"."\n" );
            $_GET_error[7] = "\"" . $phoneNumber2. "\"" . " n'est pas valide <div>" . "\n" . "Aide : '06' ou '07' et 8 chiffres </div>" . "\n";
            $resultPhoneNumberPortable = false;
        } else {
            //echo ("- la chaine '" . $phoneNumber . "' est valide <br/>"."\n" );
            $resultPhoneNumberPortable = true;
        }
    }


//ETAPE 8 : TEST DE TOUT LES RESULTATS DES CONDITIONS
    if($resultFirstName & $resultLastName & $resultEmail & $resultZipCode & $resultPhoneNumberFixe & $resultPhoneNumberPortable & $resultPassword & $resultConfPassword) {
        //echo ("- Le formulaire est envoyé <br/>"."\n" );

        //ajouter à la table register
        $dbRegister = new DatabaseRegister();
        $successRegister = $dbRegister->add_register($dataRegister);

        //ajouter à la table login
        $dbLogin = new DataBaseLogin();
        $successLogin = $dbLogin->add_login($dataLogin );

        //démarrage de la session AVANT d'écrire mon code HTML

            if (session_status() != PHP_SESSION_ACTIVE)
                session_start();
                $admin = 'martinezyoann83@gmail.com';//mail à changer pour l'admin + login_controller

                if ($email != $admin){
                    //création des variables de session dans $_SESSION
                    $_SESSION['mail'] = $email;
                    $_SESSION['prenom'] = $firstName;
                    $_SESSION['nom'] = $lastName;
                    $_SESSION['visible'] = 'visible';
                    $_SESSION['Admin'] = 'hide';
                    $_SESSION['hide'] = 'hide';
                    //echo "utilisateur connecté";
                    //echo "$email";

                } else {
                    $_SESSION['mail'] = $email;
                    $_SESSION['nom'] = $lastName;
                    $_SESSION['prenom'] = $firstName;
                    $_SESSION['visible'] = 'visible';
                    $_SESSION['Admin'] = 'visible';
                    $_SESSION['hide'] = 'hide';
                    //echo "admin connecté";
                }

        //Déclaration de l'adresse de destination
        $mailAdmin = 'martinezyoann83@gmail.com';

        //Déclaration de l'adresse de client
        $mailCustomer = $email;

        //On filtre les serveurs qui rencontrent des bogues
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailCustomer)) {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }


//ETAPE 9: Déclaration du message

        //message pour le client
        $message_txtCustomer = "<div style='color: #494949; text-align: center;'>
                                  <img src=\"https://cdn.pixabay.com/photo/2014/04/02/16/23/coffee-307147_960_720.png \" style='width: 80px; border-radius: 50%; '>
                                  <p style='color: #4b3089;'>Restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                  <p>Bonjour <span style='color: #4b3089'>".$title." ".$firstName." ".$lastName."</span>, nous vous souhaitons la bienvenue sur le site : <span style='color: #4b3089'>LE 3SET</span></p>
                                  <p>Dorénavant vous pouvez <span style='color: #4b3089'>réserver une table ou notre salle d'évènement</span> ainsi que poster <span style='color: #4b3089'>un avis !</span></p>
                                  <p>Cordialement, l'équipe du <span style='color: #c952b5'>Tennis Club Toulonnais.</span></p>
                                  <p style='font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
                                  <p style='font-size: 0.6em;'>Pour pouvoir vous désabonner de la News-letter, veuillez <span style='color: #c952b5'>nous contacter sur notre site Le 3SET.</span></p>
                                </div>";
        $message_htmlCustomer = "<div style='color: #494949; text-align: center;'>
                                  <img src=\"https://cdn.pixabay.com/photo/2014/04/02/16/23/coffee-307147_960_720.png \" style='width: 80px; border-radius: 50%; '>
                                  <p style='color: #4b3089;'>Restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                  <p>Bonjour <span style='color: #4b3089'>".$title." ".$firstName." ".$lastName."</span>, nous vous souhaitons la bienvenue sur le site : <span style='color: #4b3089'>LE 3SET</span></p>
                                  <p>Dorénavant vous pouvez <span style='color: #4b3089'>réserver une table ou notre salle d'évènement</span> ainsi que poster <span style='color: #4b3089'>un avis !</span></p>
                                  <p>Cordialement, l'équipe du <span style='color: #c952b5'>Tennis Club Toulonnais.</span></p>
                                  <p style='font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
                                  <p style='font-size: 0.6em;'>Pour pouvoir vous désabonner de la News-letter, veuillez <span style='color: #c952b5'>nous contacter sur notre site Le 3SET.</span></p>
                                </div>";

        // Création de la boundary
        $boundary = "-----=".md5(rand());

        //Création du header de l'e-mail
        $header = "From: \"Le 3SET\"<le3SETr@mail.fr>".$passage_ligne;
        $header.= "Reply-to: \"Le 3SET\" <le3SET@mail.fr>".$passage_ligne;
        $header.= "MIME-Version: 1.0".$passage_ligne;
        $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        //Création du message
        $message = $passage_ligne."--".$boundary.$passage_ligne;

        //Ajout du message au format texte
        $message.= "Content-Type: text/html; charset= utf8".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_txtCustomer.$passage_ligne;

        $message.= $passage_ligne."--".$boundary.$passage_ligne;

        //Ajout du message au format HTML
        $message.= "Content-Type: text/html; charset= utf8".$passage_ligne;
        $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
        $message.= $passage_ligne.$message_htmlCustomer.$passage_ligne;

        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;


//ETAPE 10 : ENVOI DU EMAIL CLIENT

        //Envoi de l'e-mail pour le client
        mail($mailCustomer,"Message envoyé du Tennis Club Toulonnais ",$message,$header);

        //echo 'envoi du mail';
        echo('<script>
                alert("Félicitation, vôtre enregistrement à bien été effectué !");
              </script>');
        //redirection à la page d'accueil du projet
        header('index.php');

    } else {
        //echo ("- Le formulaire est arrété <br/>"."\n" );
    }

}




