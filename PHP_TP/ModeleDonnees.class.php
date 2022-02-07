<?php

abstract class Donnees{
    
    function getConnexion(){
        try {
            $adresseBDD = 'mysql:host=localhost;dbname=restaurant';
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $pdo = new PDO($adresseBDD, 'userCodePHP', 'IbkYily_p][.O(A@', $options);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
    
        } catch (PDOException $e) {
            throw new Exception("Nous avons un problème de connexion à la base de données ... -> ".$e->getMessage());
        }
    }

}

class Restaurant extends Donnees{

    public function getAllRestaurants(){
        try{
            $pdo = parent::getConnexion();
            $query = 'SELECT * FROM restaurants';
            $statement = $pdo->query($query);
            $arrAll = $statement->fetchAll();
            return $arrAll;
        }catch(PDOException $e) {
            throw new Exception("Youstone we've got a problem ! -> ".$e->getMessage());
        }
    }

    public function getRestaurantsWhereId($id){
        try{
            $pdo = parent::getConnexion();
            // $query = 'SELECT * FROM restaurants INNER JOIN avis ON restaurants.idRestaurant = avis.idRestaurant = :id'; PAS POSSIBLE CAR AVIS PEUT ETRE VIDE
            $query = 'SELECT * FROM restaurants WHERE idRestaurant = :id';
            $prep = $pdo->prepare($query);
            $prep->bindValue(':id',$id);
            $prep->execute();
            $array = $prep->fetch();
            if(empty($array))throw new Exception("Nous n'avons pas pu récupérer les informations de ce restaurant."); 
            return $array;
        }catch(PDOException $e) {
            throw new Exception("Youstone we've got a problem ! -> ".$e->getMessage());
        }
    }
}

class Avis extends Donnees{

    public function getAvisWhereIdRestaurant($id){
        try{
            $pdo = parent::getConnexion();
            $query = 'SELECT * FROM avis WHERE idRestaurant = :id';
            $prep = $pdo->prepare($query);
            $prep->bindValue(':id',$id);
            $prep->execute();
            $array = $prep->fetchAll();
            if(empty($array))throw new Exception("Nous n'avons pas pu récupérer d'avis concernant ce restaurant."); 
            return $array;
        }catch(PDOException $e) {
            throw new Exception("Youstone we've got a problem ! -> ".$e->getMessage());
        }
    }
}