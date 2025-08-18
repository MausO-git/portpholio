<?php
    try{
        $bdd = new PDO("mysql:host=localhost;dbname=portefolio_oscar;charset=utf8","root","",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e)
    {
        die("Erreur: ".$e->getMessage());
    }
?>