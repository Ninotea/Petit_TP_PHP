<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Acceuil</title>
        <link rel="stylesheet" href="style.css">
    </head>
<?php require 'Navigation.php'; ?>
<body id="body" >
    <?php
    if(isset($_GET['action']))
    {
        switch($_GET['action']){
        case 'resto':
            require 'vueRestaurant.php';
            break;
        case 'user':
            require 'vueUtilisateur.php';
            break;
        }
    }else{
        require 'vueAcceuil.php';
    }
    
    if(isset($erreur)){
        echo '<p style="width : 400 px; color:goldenrod">'.$erreur.'</p>';
    }
    ?>

</body>