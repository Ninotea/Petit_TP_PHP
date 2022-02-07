
<p>
    Voici une liste des restaurants :
</p>

<?php
require 'ModeleDonnees.class.php';

if(!empty($_GET['idResto'])){
    $idRestaurant = strip_tags($_GET['idResto']);
    $InstanceDAL = new Restaurant;
    $InstanceDAL2 = new Avis;
    try{
        $arrayUnResto = $InstanceDAL->getRestaurantsWhereId($idRestaurant);
        
        try{
            $arrayAvis = $InstanceDAL2->getAvisWhereIdRestaurant($idRestaurant);
        }catch(Exception $message){
            $erreurAvis = $message;
        }

        $htmlDetailResto = 
        '<div id="detailResto">
            <h3>'.$arrayUnResto['nom'].'</h3>
            <p>
            '.$arrayUnResto['adresse'].'<br>
            '.$arrayUnResto['cp'].'<br>
            '.$arrayUnResto['telephone'].'<br>
            </p>
            <h3>Description</h3>
            <p>
            '.$arrayUnResto['description'].'
            </p>
            <h3>AVIS</h3>';

            if(!isset($erreurAvis)){
                foreach ($arrayAvis as $key => $unArrayAvis) {
                    foreach ($unArrayAvis as $key => $value) {
                        if($unArrayAvis[$key] == "") $unArrayAvis[$key] = "<i>Inconnu</i>";
                    }
                    $htmlDetailResto .= '<p>'.$unArrayAvis['auteur'].' : "'.$unArrayAvis['note'].' Fourchettes sur 5" <br>
                    '.$unArrayAvis['commentaire'].'</p>';
                } 
            }else{
                $htmlDetailResto .= '<p>'.$erreurAvis.'</p>';
            }

        $htmlDetailResto .= '</div>';

        echo $htmlDetailResto;

    }catch(Exception $message){
        $erreur = $message;
    }
}