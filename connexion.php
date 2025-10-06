<?php
    try{
        $bdd = new PDO("mysql:host=localhost;dbname=maos7372_works_ptf;charset=utf8","maos7372_mauso","5y79-wtBn-4Cp{",[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e)
    {
        die("Erreur: ".$e->getMessage());
    }
?>