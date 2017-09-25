<?php

class Advertise_Undelivery {
    
    public function sendEmail($aDestinataire){
        
        for ($i = 0; $i < sizeof($aDestinataire) - 2; $i++){
            $to .= $aDestinataire[$i].', ';
        }
        $to .= $aDestinataire[sizeof($aDestinataire) - 1];
        $subject = 'Casier non rendu';
        $sMessage = "
                <html>
                <head>
                  <title align=\"center\">Casier non rendu</title>
                </head>
                <body>
                <div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
                  <h1 align=\"center\">Casier non rendu</h1>
                  <div align=\"center\">
                    <img src=\"https://cados.website/CadosProject/data/genere/dev-cados/public/css/images/Rouge.png\" height=\"154\" width=\"320\" alt=\"Cados logo\">
                  </div>
                  <div align=\"center\">
                        <p><font size=\"4\">Bonjour chère utilisateur,</font></p>
                        <p><font size=\"4\">Tu as réserver un casier et nous t'informons qu'il ne te reste plus que quelques minutes avant la restitution de celui-ci.</font></p>
                        <p><font size=\"4\">Il est important de jouer le jeux afin que tout le monde puisse bénéficier des casiers.</font></p> 
                        <p><font size=\"4\">Je te souhaite une bonne soirée.</font></p>
                        <p><font size=\"4\">Cordialement,</font></p>
                        <p><font size=\"5\">L'équipe CADOS.</font></p>
                    </div>
                </div>
                </body>
                </html>";

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // En-têtes additionnels
//            $headers .= 'To: Test <'. $sRecipient . ">\r\n";
        $headers .= 'From: "TeamCados" <anthony.rohr@cados.website>' . "\r\n";
        $headers .= 'Reply-To: cados.development@gmail.com'."\n";
//            $headers .= 'Cc: anniversaire_archive@example.com' . "\r\n";
//            $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";

        if(mail($to, $subject, $sMessage, $headers)){
            return true;
        }else{
            return false;
        }
    }
}

$username = 'dbo675117633';
$password = 'cadosAdmin';
try{	
	$bdd = new PDO('mysql:dbname=db675117633;host=db675117633.db.1and1.com', $username, $password);
	$oUserUndelivery = $bdd->query('SELECT * FROM utilisateur WHERE id_bouton > 0');
	$aListUsers = array();
        foreach ($oUserUndelivery as $oUser){
            array_push($aListUsers, $oUser['email']);
	}
        
}catch(Exception $e){

	die('Erreur :'.$e->getMessage());

}


