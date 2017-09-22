<?php

$username = 'dbo675117633';
$password = 'cadosAdmin';
try{	
	$bdd = new PDO('mysql:dbname=db675117633;host=db675117633.db.1and1.com', $username, $password);
	$oUserUndelivery = $bdd->query('SELECT * FROM utilisateur WHERE id_bouton > 0');
	foreach ($oUserUndelivery as $oUser){
		var_dump($oUser);
		$nbr_jour_reservation =(int) ++$oUser['nbr_jour_reservation'];
		$id_utilisateur = (int) $oUser['id_utilisateur'];
		$requete = $bdd->prepare('UPDATE utilisateur SET nbr_jour_reservation = :nbrjour WHERE id_utilisateur = :id');
		$requete->execute(array('nbrjour' => $nbr_jour_reservation, 'id' => $id_utilisateur));
	}
}catch(Exception $e){

	die('Erreur :'.$e->getMessage());

}
