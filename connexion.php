<?php
    try{
        $bdd = new PDO("mysql:host=localhost;dbname=maos7372_works_ptf;charset=utf8","","",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e)
    {
        die("Erreur: ".$e->getMessage());
    }
?>
