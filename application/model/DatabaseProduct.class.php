<?php

class DataBaseProduct {

    private $data;

    //Connection à la base de donnée
    function __construct()
    {
        include 'application/config/config.php';
    }

    //obtenir tous les produits
    function get_Products() {
        $sql = 'SELECT
                  id,
                  picture,
                  titleProduct,
                  description,
                  priceSingle
                FROM
                  products';

        $query = $this->data->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    //obtenir un produit
    function get_Product($id) {
        $sql = 'SELECT
                  id,
                  picture,
                  titleProduct,
                  description,
                  priceSingle
                FROM
                  products
                WHERE
                  id = ?';

        $query = $this->data->prepare($sql);
        $query->execute([$id]);

        return $query->fetch();
    }

    //ajouter un produit
    function add_Product(Array $data)
    {
        $sql = 'INSERT INTO
                  products(
                   titleProduct, priceSingle, description, picture)
                VALUES(
                    ?,?,?,?)';

        $query = $this->data->prepare($sql);
        return $query->execute($data);
    }

    //supprimer un produit
    function delete_Product($id)
    {
        $sql = 'DELETE FROM
                  products
                WHERE
                  id = ?';
        $query = $this->data->prepare($sql);
        $query->execute($id);
    }

    //modifier un produit
    function edit_Product(Array $data) {
        $sql = 'UPDATE
                  products
                SET 
                  picture = ?,
                  titleProduct = ?,
                  description = ?,
                  priceSingle = ?
                  WHERE products.id = ?
                  ';

        $query = $this->data->prepare($sql);
        $query->execute($data);
    }
}