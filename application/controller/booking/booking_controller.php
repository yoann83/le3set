<?php
/*************** booking **********************/

//ETAPE 1 : DÉCOMMENTER POUR VOIR LE TEST DE MON CONTROLLER SUR MA VUE
/*$test = ("je suis dans le booking_controller");
var_dump($test);*/



//ETAPE 2 : INCLUSION DU MODEL HOME POUR LE TEXT DÉROUALNT
require_once 'application/model/DatabaseHome.class.php';
$dataHome = new DataBaseHome();
$Homes = $dataHome->get_homes();

//ETAPE 3 : AJOUTER UN UTILISATEUR A LA TABLE REGISTER
if (array_key_exists('mail_booking',$_POST)) {
    $firstName = $_POST[trim('firstName')];
    $lastName = $_POST[trim('lastName')];
    $email = $_POST[strtolower(trim('email'))];
    $date_table = $_POST['date_table'];
    $hour_table = $_POST['hour_table'];
    $number_table = $_POST['number_table'];
    $date_room = $_POST['date_room'];
    $hour_room = $_POST['hour_room'];
    $number_room = $_POST['number_room'];
    $theme_room = $_POST['theme_room'];


    //base de donnée pour la table register
    $dataRegister = [$firstName, $lastName, $email, $date_table, $hour_table, $number_table, $date_room, $hour_room, $number_room, $theme_room];

//ETAPE 4 : CREATION D'UN TABLEAU GET POUR L'AFFICHAGE DES ERREURS
    $_GET_error = [];


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

    //Number_table
    $regexNumberTable = '/^[0-9]{2,2}$/';
    $testChampNumberTable = preg_match_all($regexNumberTable, $number_table,$out);
    if (!$testChampNumberTable && $number_table != "") {
        //echo ("- ERROR la chaine '" . $number_table . "' est invalide <br/>"."\n" );
        $_GET_error[3] = "\"" . $number_table. "\"" . " n'est pas valide <div>" . "\n" . "Aide : Contient 2 chiffres </div>" . "\n";
        $resultNumberTable = false;
    } else {
        //echo ("- la chaine '" . $number_table . "' est valide <br/>"."\n" );
        $resultNumberTable = true;
    }

    //Number_room
    $regexNumberRoom = '/^[0-9]{2,2}$/';
    $testChampNumberRoom = preg_match_all($regexNumberRoom, $number_room,$out);
    if (!$testChampNumberRoom && $number_table != "") {
        //echo ("- ERROR la chaine '" . $number_room . "' est invalide <br/>"."\n" );
        $_GET_error[4] = "\"" . $number_room. "\"" . " n'est pas valide <div>" . "\n" . "Aide : Contient 2 chiffres </div>" . "\n";
        $resultNumberRoom = false;
    } else {
        //echo ("- la chaine '" . $number_room . "' est valide <br/>"."\n" );
        $resultNumberRoom = true;
    }

//ETAPE 6 : TEST DE TOUT LES RESULTATS DES CONDITIONS
    if($resultFirstName & $resultLastName & $resultEmail ) {
        //echo ("- Le formulaire est envoyé <br/>"."\n" );

        //Déclaration de l'adresse de destination
        $mailAdmin = 'martinezyoann83@gmail.com';

        //Déclaration de l'adresse de client
        $mailCustomer = $email;

        //On filtre les serveurs qui rencontrent des bogues
        if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|orange|free).[a-z]{2,4}$#", $mailCustomer)) {
            $passage_ligne = "\r\n";
        } else {
            $passage_ligne = "\n";
        }


//ETAPE 7: Déclaration des messages

        //message pour le client
        $message_txtCustomer = "<div style='color: #494949; text-align: center;'>
                                  <img src=\"https://cdn.pixabay.com/photo/2014/04/02/16/23/coffee-307147_960_720.png \" style='width: 80px; border-radius: 50%; '>
                                  <p style='color: #4b3089;'>Restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                  <p>Bonjour <span style='color: #4b3089'>".$firstName." ".$lastName."</span>, nous avons bien reçu votre demande de réservation sur le site: <span style='color: #4b3089'>LE 3SET</span></p>
                                  <p>Nous restons à votre disposition pour toute information complémentaire.</p>
                                  <div style='background-color: #c1ebff; border-radius: 10px; padding: 15px;'>
                                    <p><strong>Détail de la réservation :</strong></p>
                                    <p>Nom, prénom : <span style='color: #4b3089;'>".$firstName." ".$lastName."</span></p>
                                    <p>Adresse mail : ".$email."</p>
                                    <p>Le: ".$date_table. "$date_room"." à ".$hour_table." ".$hour_room." pour ".$number_table." ".$number_room." personnes</p>
                                    <p><em>".$theme_room."</em></p>
                                  </div>
                                  <p>Cordialement, l'équipe du <span style='color: #c952b5;'>Tennis Club Toulonnais.</span></p>
                                  <p style='background-color: #e6e6e6;font-family: cursive;padding: 15px; border-radius: 10px'>\"Nous considérons nos clients comme des invités, à une fête où nous sommes les hôtes. C'est notre job d'améliorer leur expérience un peu plus chaque jour.\"</p>
                                  <p style='font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
                                </div>";
        $message_htmlCustomer = "<html><head></head><body><b>Salut à tous</b>, voici un e-mail envoyé par un <i>script PHP</i>.</body></html>";

        // Création de la boundary
        $boundary = "-----=".md5(rand());

        //message pour l'admin
        $message_htmlAdmin = "<div style='color: #494949; text-align: center;'>
                                  <img src=\"https://cdn.pixabay.com/photo/2014/04/02/16/23/coffee-307147_960_720.png \" style='width: 80px; border-radius: 50%; '>
                                  <p style='color: #4b3089;'>Restaurant <span style='color: #c952b5;'>\"le 3Set \"</span></p>
                                  <p>Bonjour <span style='color: #4b3089'>".$firstName." ".$lastName."</span>, nous avons bien reçu votre demande de réservation sur le site: <span style='color: #4b3089'>LE 3SET</span></p>
                                  <p>Nous restons à votre disposition pour toute information complémentaire.</p>
                                  <div style='background-color: #c1ebff; border-radius: 10px; padding: 15px;'>
                                    <p><strong>Détail de la réservation :</strong></p>
                                    <p>Nom, prénom : <span style='color: #4b3089;'>".$firstName." ".$lastName."</span></p>
                                    <p>Adresse mail : ".$email."</p>
                                    <p>Le: ".$date_table. "$date_room"." à ".$hour_table." ".$hour_room." pour ".$number_table." ".$number_room." personnes</p>
                                    <p><em>".$theme_room."</em></p>
                                  </div>
                                  <p>Cordialement, l'équipe du <span style='color: #c952b5;'>Tennis Club Toulonnais.</span></p>
                                  <p style='background-color: #e6e6e6;font-family: cursive;padding: 15px; border-radius: 10px'>\"Nous considérons nos clients comme des invités, à une fête où nous sommes les hôtes. C'est notre job d'améliorer leur expérience un peu plus chaque jour.\"</p>
                                  <p style='font-size: 0.6em; color: #4b3089; font-style: italic'>Veuillez ne pas répondre à ce mail envoyé automatiquement.</p>
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
                alert("Vôtre réservation à été envoyé avec succès ! Veuillez consulter votre boite mail pour visualiser le récapitulatif de votre réservation.");
              </script>');

        //redirection à la page d'accueil du projet
        header('index.php');

    } else {
        //echo ("- Le formulaire est arrété <br/>"."\n" );
    }



}