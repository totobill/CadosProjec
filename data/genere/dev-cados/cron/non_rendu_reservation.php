<?php
$username = 'dbo675117633';
$password = 'cadosAdmin';
$bdd = new PDO('mysql:dbname=db675117633;host=db675117633.db.1and1.com', $username, $password);
$oUserUndelivery = $bdd->query('SELECT * FROM utilisateur WHERE id_bouton > 0');

foreach ($oUserUndelivery as $oUser){
    $oUser->nbr_jour_reservation += 1;
    
    if($oUser->save()){
        
    }else{
        echo 'erreur';
    }
}

