<?php

class DataBaseLogin
{

    private $data;

    //Connection à la base de donnée
    function __construct()
    {
        include 'application/config/config.php';
    }

    //obtenir tous les utilisateurs
    function get_logins() {
        $sql = 'SELECT
                  id,
                  firstName,
                  lastName,
                  email,
                  password
                FROM
                  logins
                ORDER BY 
                id
                DESC limit 
                      0,10
                 ';

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //obtenir un utilisateur
    function get_login($email) {
        $sql = 'SELECT
                  id,
                  firstName,
                  lastName,
                  email,
                  password
                FROM
                  logins
                WHERE
                  email = ?';

        $query = $this->data->prepare($sql);
        $query->execute([$email]);

        return $query->fetch();
    }

    //ajouter un utilisateur
    function add_login(Array $data)
    {
        $sql = 'INSERT INTO
                  logins(
                   firstName, lastName, email, password)
                VALUES(
                    ?,?,?,?)';

        $query = $this->data->prepare($sql);
        return $query->execute($data);
    }

    //le mail existe return un boleen
    function get_mail($data) {
        $sql = "SELECT
                  *
                FROM
                  logins
                WHERE 
                  email
                LIKE 
                     '$data'
                 ";

        $query = $this->data->prepare($sql);
        $query->execute();

        $result = $query->rowCount();
        return $result;
    }

    //Si le password existe return un boleen
    function get_password($data) {
        $sql = "SELECT
                  *
                FROM
                  logins
                WHERE 
                  password
                LIKE 
                     '$data'
                 ";

        $query = $this->data->prepare($sql);
        $query->execute();

        $result = $query->rowCount();
        return $result;
    }

}