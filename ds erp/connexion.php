<?php
      $serveur = "localhost";
      $base ="ds_erp";
      $utilisateur="root";
      $motdepasse="";
      try{
            //création d'une instance de PDO
            $db = new PDO("mysql:host=$serveur;dbname=$base",$utilisateur,$motdepasse);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $ex){
            echo "Echec de connexion :".$ex->getMessage();
      }
?>
