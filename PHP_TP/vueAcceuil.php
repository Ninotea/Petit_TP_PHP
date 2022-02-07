
<?php
        require_once 'ModeleDonnees.class.php';

        $instanceDAL = new Restaurant;
        try {
            $arrayRestaurants = $instanceDAL->getAllRestaurants();
        }catch(Exception $message){
            $erreur = $message;
        }

        if(sizeOf($arrayRestaurants)>0){
            $htmlRestaurant = '<div id="restaurants" name="restaurants" class="restaurants">';
            foreach ($arrayRestaurants as $key => $resto) {
                $htmlRestaurant .= '<a href="index.php?action=resto&idResto='.$resto['idRestaurant'].'">'.$resto['nom'].'</a><br>';
            }
            $htmlRestaurant .= '</div>';
        }

        if(isset($htmlRestaurant))echo $htmlRestaurant;