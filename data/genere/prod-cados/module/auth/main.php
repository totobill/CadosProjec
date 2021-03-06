<?php

//require '/var/www/html/PHPMailer-master/PHPMailerAutoload.php';

class module_auth extends abstract_module{
	
	//longueur maximum du mot de passe
	private $maxPasswordLength=100;
	
	public function before(){
		//on active l'authentification
		_root::getAuth()->enable();

		$this->oLayout=new _layout('bootstrap');
                $this->oLayout->addModule('menu','menu_auth::index');
	}

	public function _login(){
		
            if(isset($_GET['log']) && isset($_GET['cle'])){
			
                $email = htmlspecialchars($_GET['log']);
                $cle = htmlspecialchars($_GET['cle']);

                $iIdUtilisateur = model_utilisateur::getInstance()->getIdUtilisateur($email);				
                $aConfirmation = model_utilisateur::getInstance()->getConfirmation($iIdUtilisateur->id_utilisateur);

                if($aConfirmation->actif == 1){
                        $sConfirmation = "Vous avez déjà confirmé votre compte.";
                } else {
                    if($aConfirmation->cle != $cle){
                            $sConfirmation = "Erreur. Votre compte ne peux pas être activé.";
                    }else{
                            model_utilisateur::getInstance()->setActif($iIdUtilisateur->id_utilisateur);
                            $sConfirmation = "Votre compte à bien été activé.";
                    }
                }			
            }else{
                $sConfirmation = "";
            }

            $sMessage=$this->checkLoginPass();

            $oView=new _view('auth::login');
            $oView->sError=$sMessage;
            if(isset($_GET['log'])){$oView->sEmail=$email;}
            $oView->sConfirmation=$sConfirmation;
            $this->oLayout->add('main',$oView);

	}


	private function checkLoginPass(){
		//si le formulaire n'est pas envoye on s'arrete la
		if(!_root::getRequest()->isPost() ){
			return null;
		}
		
		$sLogin=_root::getParam('login');
		$sPassword=_root::getParam('password');
		
		if(strlen($sPassword) > $this->maxPasswordLength){
			return 'Mot de passe trop long';
		}
		
		//on stoque les mots de passe hashe dans la classe model_utilisateur
		$sHashPassword=model_utilisateur::getInstance()->hashPassword($sPassword);
		$tAccount=model_utilisateur::getInstance()->getListAccount();
		
		//on va verifier que l'on trouve dans le tableau retourne par notre model
		//l'entree $tAccount[ login ][ mot de passe hashe ]
		if(!_root::getAuth()->checkLoginPass($tAccount,$sLogin,$sHashPassword)){
			return 'Mauvais login/mot de passe';
		}
		
                $oUser=_root::getAuth()->getAccount();
                model_rightsManagerMulti::getInstance()->loadForUser($oUser);


/* if(isset($oUser)){
        	$iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
		$aInfoConfirmation = model_utilisateur::getInstance()->getConfirmation($iIdUtilisateur);
		if($aInfoConfirmation->actif == 1){
			//model_utilisateur::getInstance()->setConnecte1($iIdUtilisateur);
		}else{
			return 'Veuillez confirmer votre email pour pouvoir vous connecter.';
		} 
                    
            }*/
                
		_root::redirect('default::index');
                
                

//                _root::redirect('privatemodule_action');
                /*pour accéder à l'administration des droits*/
                // index.php?:nav=rightsManagerMulti::index
	}

	public function _inscription(){
		$tMessage=$this->processInscription();

		$oView=new _view('auth::inscription');
		$oView->tMessage=$tMessage;

		$oView->oUser=new row_utilisateur;
		
		$this->oLayout->add('main',$oView);
	}


public function sendEmailinscription($sRecipient,$sName,$sSurname,$cle){
		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "cados.development@gmail.com";

		//Password to use for SMTP authentication
		$mail->Password = "cadosAdmin2017";

		//Set who the message is to be sent from
		$mail->setFrom('cados.development@gmail.com', 'Cados');

		//Set an alternative reply-to address
		$mail->addReplyTo('cados.development@gmail.com', 'Cados');

		//Set who the message is to be sent to
		$mail->addAddress($sRecipient, $sSurname);

		//Set the subject line
		$mail->Subject = 'Confirmation inscription Cados';
		
		$msgHtml = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">
				<html>
				<head>
				  <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
				  <title>Confirmation Inscription</title>
				</head>
				<body>
				<div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
				  <h1>Confirmation d'inscription à Cados</h1>
				  <div align=\"center\">
				    <a href=\"https://github.com/PHPMailer/PHPMailer/\"><img src=\"images/phpmailer.png\" height=\"90\" width=\"340\" alt=\"PHPMailer rocks\"></a>
				  </div>
					<p> Salut" .$sSurname. ", bienvenu sur Cados. Tu viens de t'inscrire sur l'appli web, et pour finaliser tout ça je te propose de confirmer ton inscription. </p>
					<p> Pour cela rien de plus simple, clique sur le liens pour vite nous rejoindre ainsi que toute la communauté. </p> 
					<a href=\"http://cados.zapto.org/public/index.php?:nav=auth::login&log=$sRecipient&cle=$cle\">
						http://cados.zapto.org/public/index.php?:nav=auth::login&log=$sRecipient&cle=$cle
					</a>
				</div>
				</body>
				</html>";
				
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('/var/www/html/module/auth/view/contents.html'), dirname(__FILE__));
		$mail->isHTML(true);
		$mail->Body = $msgHtml;

		//Replace the plain text body with one created manually
		$mail->AltBody = 'This is a plain-text message body';

		//Attach an image file
		$mail->addAttachment('/var/www/html/module/auth/view/Bleu Provence.png');
		$mail->send();
		//send the message, check for errors
		//if (!$mail->send()) {
		//    echo "Mailer Error: " . $mail->ErrorInfo;
		//} else {
		//    echo "Message sent!";
		//}
		
	}




	private function processInscription(){
		if(!_root::getRequest()->isPost()){
			return null;
		}
		
		$tAccount=model_utilisateur::getInstance()->getListAccount();
		
		$sLogin=_root::getParam('email');
		$sPassword=_root::getParam('password');
                $sName = _root::getParam('nom');
                $sSurname = _root::getParam('prenom');
                $dBirthday = _root::getParam('date_de_naissance');

		if($sPassword!=_root::getParam('password2')){
			return array('email'=>array('Les deux mots de passe doivent etre identiques'));
		}elseif($sLogin==''){
			return array('email'=>array('Vous devez remplir le nom d utilisateur'));
		}elseif($sPassword==''){
			return array('email'=>array('Vous devez remplir le mot de passe'));
		}elseif(strlen($sPassword) > $this->maxPasswordLength){
			return array('email'=>array('Mot de passe trop long'));
		}elseif(isset($tAccount[$sLogin]) ){
			return array('email'=>array('Utilisateur déjà existant'));
		}

		$oUtilisateur=new row_utilisateur;
		$oUtilisateur->email=$sLogin;
		$oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sPassword);
                $oUtilisateur->nom=$sName;
                $oUtilisateur->prenom=$sSurname;
                $oUtilisateur->date_de_naissance=$dBirthday;
		if($oUtilisateur->save()==false){

			return $oUtilisateur->getListError();
			
		}

		$cle = md5(microtime(TRUE)*100000);
	    //echo $cle;
	    //model_utilisateur::getInstance()->setCle($sLogin,$cle);	
	    //$this->sendEmailinscription($sLogin,$sName,$sSurname,$cle);
            return array('success'=>array('Votre compte a bien été créé. Veuillez confirmer votre compte, un email vous a été envoyé.'));

	}

	public function _logout(){
            $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
            model_utilisateur::getInstance()->setConnecte0($iIdUtilisateur);		

           _root::getAuth()->logout();
	}

	public function after(){
		$this->oLayout->show();
	}
}
