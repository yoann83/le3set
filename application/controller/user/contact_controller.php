<?php
/*************** contact **********************/

//ETAPE 1 : TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le contact_controller");
var_dump($test);*/


//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROULANT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();


//ETAPE 3 : AJOUTER UN UTILISATEUR A LA TABLE REGISTER
if (array_key_exists('send_mail',$_POST)) {
    $firstName  = $_POST[trim('firstName')];
    $lastName   = $_POST[trim('lastName')];
    $email      = $_POST[strtolower(trim('email'))];
    $theme      = $_POST['theme'];
    $text_mail  = $_POST['text_mail'];

    //base de donnée pour la table register
    $dataRegister = [
        $firstName,
        $lastName,
        $email,
        $theme,
        $text_mail
    ];


//ETAPE 4 : CREATION D'UN TABLEAU GET POUR L'AFFICHAGE DES ERREURS
    $_GET_error=[];


//ETAPE 5 : TEST DES CHAMPS DE SAISIE

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

    //Email
    $regexEmail = '/^[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/';
    $testChampEmail = preg_match_all($regexEmail, $email,$out);
    if (!$testChampEmail) {
        //echo ("- ERROR la chaine '" . $email . "' est invalide <br/>"."\n" );
        $_GET_error[2] = "\"" . $email. "\"" . " n'est pas valide <div>" . "\n" . "Aide : le caractère '@' et le point '.' est requis </div>" . "\n";
        $resultEmail = false;
    } else {
        //echo ("- la chaine '" . $email . "' est valide <br/>"."\n" );
        $resultEmail = true;
    }

//ETAPE 6 : TEST DE TOUT LES RESULTATS DES CONDITIONS

    if($resultFirstName & $resultLastName & $resultEmail) {
        //echo ("- Le formulaire est envoyé <br/>"."\n" );

        //Déclaration de l'adresse de destination
        $mailAdmin = 'martinezyoann83@gmail.com'; // changer le mail de l'admin

        //Déclaration de l'adresse de client
        $mailCustomer = $email;

        //On filtre les serveurs qui rencontrent des bogues
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailCustomer)) {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }

//ETAPE 7: Déclaration des messages

        //message pour le client
        $message_txtCustomer = "<div style='color: #494949; text-align: center;'>
                                  <img src=\"https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-0/c0.0.370.370/p370x247/29177461_2115837555354666_1454104406534376616_n.jpg?_nc_cat=102&_nc_ht=scontent-cdg2-1.xx&oh=7b851817755900ef286954d0732577c6&oe=5C844CD0 \" style='width: 80px; border-radius: 50%; '>
                                  <p style='color: #4b3089;'>Information du restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                  <p>Bonjour <span style='color: #4b3089'>" .$firstName."</span>, nous avons bien reçu votre demande concernant la rubrique: <span style='color: #4b3089'>".$theme. ".</span></p>
                                  <p>Soyez assurés que nous faisons de notre mieux pour vous répondre au plus vite.</p>
                                  <div style='color: #494949; text-align: left;'>
                                    <p style='margin-top: 50px; color: #494949;'><strong>Récapitulatif de votre message: </strong></p>
                                    <p style='background-color: #e6e6e6; padding: 15px; border-radius: 10px'>" .$text_mail."</p>
                                    <p style='text-align: center; font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
                                  </div>
                                    <p>Cordialement, l'équipe du <span style='color: #c952b5'>Tennis Club Toulonnais.</span></p>
                                </div>";

        $message_htmlCustomer = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";

        // Création de la boundary
        $boundary = "-----=".md5(rand());

        //message pour l'admin
        $message_htmlAdmin = "<div style='color: #494949; text-align: center;'>
                                <img src=\"https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-0/c0.0.370.370/p370x247/29177461_2115837555354666_1454104406534376616_n.jpg?_nc_cat=102&_nc_ht=scontent-cdg2-1.xx&oh=7b851817755900ef286954d0732577c6&oe=5C844CD0 \" style='width: 80px; border-radius: 50%; '>
                                <p style='color: #4b3089;'>Information du restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                <p>Bonjour la personne <span style='color: #4b3089'>" .$lastName." ".$firstName."</span>, vous a envoyer une demande concernant la rubrique: <span style='color: #4b3089'>".$theme. ".</span></p>
                                <p>Adresse mail : ".$mailCustomer."</p>
                                <div style='color: #494949; text-align: left;'>
                                    <p style='margin-top: 50px; color: #494949;'><strong>Message: </strong></p>
                                    <p style='background-color: #e6e6e6; padding: 15px; border-radius: 10px'>".$text_mail."</p>
                                    <p style='text-align: center; font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
                                </div>
                                <p style='font-size: 0.6em;'>Cordialement, le WebMaster <span style='color: #c952b5;'>Yoann Martinez.</span></p>
                              </div>";

        //Création du header de l'e-mail
        $header = "From: \"Le 3SET\"<le3SET@mail.fr>".$passage_ligne;
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
        $message.= $passage_ligne.$message_htmlAdmin.$passage_ligne;

        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
        $message.= $passage_ligne."--".$boundary."--".$passage_ligne;


//ETAPE 8 : ENVOI DES EMAILS CLIENT ET ADMINISTRATEUR

        //Envoi de l'e-mail pour l'administrateur
        mail($mailAdmin,"Message du site le 3Set. ",$message,$header);

        //Envoi de l'e-mail pour le client
        mail($mailCustomer,"Message envoyé du Tennis Club Toulonnais ",$message,$header);

        //Test de l'envoi du mail
            //echo 'envoi du mail réussi';

        echo('<script>
                alert("Votre message a été envoyé avec succès ! Un e-mail vous a été envoyé. Veuillez consulter votre boite mail pour visualiser le récapitulatif de votre message.");
              </script>');

        //redirection à la page d'accueil du projet
        header('index.php');

    } else {
        //echo ("- Le formulaire est arrété <br/>"."\n" );
    }

}