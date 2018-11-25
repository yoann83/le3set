<?php

class DatabaseRegister {

    private $data;

    //Connection à la base de donnée du restaurant TCT
    function __construct()
    {
        include 'application/config/config.php';
    }

    //obtenir tout les informations concernant l'utilisateurs
    function get_registers() {
        $sql = 'SELECT
                  id,
                  title,
                  firstName,
                  lastName,
                  email,
                  password,
                  adressLine1,
                  adressLine2,
                  city,
                  zipCode,
                  phoneNumber,
                  phoneNumber2,
                  newLetter
                FROM
                  registers';

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //ajouter des informations concernant utilisateur
    function add_register(Array $data){
        $sql = 'INSERT INTO
                  registers(                
                    title,
                    firstName,
                    lastName,
                    email,
                    password,
                    adressLine1,
                    adressLine2,
                    city,
                    zipCode,
                    phoneNumber,
                    phoneNumber2,
                    newLetter)
                VALUES(
                    ?,?,?,?,?,?,?,?,?,?,?,?)';

        $query = $this->data->prepare($sql);
        return $query->execute($data);
    }

    //afficher des informations concernant d'un utilisateur qui participe à la newsletter
    function new_letter() {
        $sql = "SELECT
                  id,
                  title,
                  firstName,
                  lastName,
                  email,
                  password,
                  adressLine1,
                  adressLine2,
                  city,
                  zipCode,
                  phoneNumber,
                  phoneNumber2,
                  newLetter
                FROM
                  registers
                where 
                  newLetter = 1
                GROUP BY 
                id
                DESC LIMIT 10
                ";

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }


}
