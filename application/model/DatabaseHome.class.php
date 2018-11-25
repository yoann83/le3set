<?php

class DataBaseHome
{

    private $data;

    //Connection à la base de donnée
    function __construct()
    {
        include 'application/config/config.php';
    }

    //obtenir toutes les données à la table homes
    function get_homes() {
        $sql = 'SELECT
                  id,
                  title,
                  textHome,
                  pop
                FROM
                  homes
                 ';

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //modifier l'article de la table homes
    function edit_home(Array $data) {
        $sql = 'UPDATE 
                  homes 
                SET 
                  title = ?,
                  textHome = ?
                WHERE 
                  homes.id = 1 ';

        $query = $this->data->prepare($sql);
        $query->execute($data);
    }

    //modifier le text déroulant de la table homes
    function edit_pop(Array $data) {
        $sql = 'UPDATE 
                  homes 
                SET 
                  pop = ? 
                WHERE 
                  homes.id = 1 ';

        $query = $this->data->prepare($sql);
        $query->execute($data);
    }
}
