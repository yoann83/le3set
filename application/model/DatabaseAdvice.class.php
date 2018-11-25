<?php

class DataBaseAdvice
{

    private $data;

    //Connection à la base de donnée
    function __construct()
    {
        include 'application/config/config.php';
    }

    //obtenir tous les avis
    function get_advices() {
        $sql = 'SELECT
                  id,
                  firstName,
                  titleAdvice,
                  advice
                FROM
                  advices
                ORDER BY 
                id
                DESC limit 
                      0,5
                 ';

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //ajouter un avis
    function add_advice(Array $data)
    {
        $sql = 'INSERT INTO
                  advices(
                   firstName,advice, titleAdvice)
                VALUES(
                    ?,?,?)';

        $query = $this->data->prepare($sql);
        return $query->execute($data);
    }

    //supprimer un avis
    function delete_advice($id)
    {
        $sql = 'DELETE FROM
                  advices
                WHERE
                  id = ?';
        $query = $this->data->prepare($sql);
        $query->execute($id);
    }

}