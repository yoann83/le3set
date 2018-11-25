<?php

//connexion à la base de données blog sur localhost
$this->data = new PDO('mysql:host=localhost;dbname=restauranttct;charset=UTF8','root','Yoann1995$',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

//Assigne les codes d'erreur
$this->data->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Mode de récupération par défaut
$this->data->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//Renvoie le résultat en français
$this->data->query("SET lc_time_names = 'fr_FR';");