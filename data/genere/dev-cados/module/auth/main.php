<?php

require '/kunden/homepages/46/d675115566/htdocs/CadosProject/data/genere/dev-cados/PHPMailer-master/PHPMailerAutoload.php';

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


                if(isset($oUser)){
                    $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
                    $aInfoConfirmation = model_utilisateur::getInstance()->getConfirmation($iIdUtilisateur);
		if($aInfoConfirmation->actif == 1){
                    model_utilisateur::getInstance()->setConnecte1($iIdUtilisateur);
		}else{
                    return 'Veuillez confirmer votre email pour pouvoir vous connecter.';
		} 
                    
            }
                
		_root::redirect('default::index');
                
                

//                _root::redirect('privatemodule_action');
                /*pour accéder à l'administration des droits*/
                // index.php?:nav=rightsManagerMulti::index
	}

        public function _inscription(){
            $tMessage=$this->processInscription();
            if(isset($tMessage) and array_key_exists('success', $tMessage)){
                $oView=new _view('auth::login');
            }else{
                $oView=new _view('auth::inscription');
                $tQuestions=model_QuestionSecrete::getInstance()->getSelect();
                $oView->tQuestions=$tQuestions;
            }
            $oView->tMessage=$tMessage;
            
            $oView->oUser=new row_utilisateur;

            $this->oLayout->add('main',$oView);
        }
        
        public function _forgotPasswordEmail(){
            $tMessage = $this->checkEmail();
            //Si tMessage est différent de null, c'est que le questionnaire a été soumis
            if(isset($tMessage)and array_key_exists('success', $tMessage)){
                $oView = new _view('auth::forgotPasswordQuestion');
                $sEmail = _root::getParam('email');
                $oUtilisateur = model_utilisateur::getInstance()->findByEmail($sEmail);
                $oView->email=$sEmail;
                $oView->oUser=$oUtilisateur;
            }else{
                $oView = new _view('auth::forgotPasswordEmail');
                $oView->oUser=new row_utilisateur;
            }
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
        }
        
        public function checkEmail(){
           //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }
            
           $sLogin = _root::getParam('email');
           $tAccount=model_utilisateur::getInstance()->getListEmail();
           //On vérifie si l'adresse email entrée existe en base.
           //Si elle n'existe pas en renvoie un message d'erreur
           if(!_root::getAuth()->checkEmail($tAccount,$sLogin)){
               return array('email' => 'L\'adresse email fourni n\'existe pas.');
           //Si elle existe, alors on renvoie un message de succès.
           }else{
               return array('success' => '');
           }
           
        }
        
        public function _forgotPasswordQuestion(){
            $tMessage = $this->checkSecretQuestion();
            if(isset($tMessage)and array_key_exists('success', $tMessage)){
                $oView = new _view('auth::forgotPasswordNew');
                $sLogin = _root::getParam('email');
                $oUtilisateur=model_utilisateur::getInstance()->findByEmail($sLogin);
                $oView->oUser=$oUtilisateur;
            }else{
                $oView = new _view('auth::forgotPasswordQuestion');
                $oView->oUser=new row_utilisateur;
            }
            $oView->tMessage=$tMessage;

            $this->oLayout->add('main',$oView);
        }
        
        
        public function checkSecretQuestion(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }
            
            $sLogin = _root::getParam('email');
            $sAnswer = _root::getParam('answer');
            $oUtilisateur = model_utilisateur::getInstance()->findByEmail($sLogin);
            if($oUtilisateur->answser != $sAnswer){
                return array('answer' => 'La réponse ne correspond pas');
            }else{
                return array('succes' => '');
            }
            
            
            if($oUtilisateur->answser != $sAnswer){
                return array('answer' => 'Le réponse fournie ne correspond pas avec la réponse en base de donnée');
            }
        }
        
        public function _forgotPasswordNew(){
            $tMessage=$this->checkNewPassword();
            if(isset($tMessage)and array_key_exists('success', $tMessage)){
                $oView = new _view('auth::login');
            }else{
                $oView = new _view('auth::forgotPasswordNew');
                $sLogin = _root::getParam('email');
                $oUtilisateur=model_utilisateur::getInstance()->findByEmail($sLogin);
                $oView->oUser=$oUtilisateur;
            }
            $oView->tMessage=$tMessage;
            $this->oLayout->add('main',$oView);
        }
        
        public function checkNewPassword(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }
            $sLogin = _root::getParam('email');
            $sPassword = _root::getParam('password');
            $sConfirmationPassword = _root::getParam('confirmationPassword');
            if(strcmp($sPassword, $sConfirmationPassword) != 0){
                return array('password' => 'Le mot de passe et la confirmation ne sont pas identiques.');
            }else{
                $oUtilisateur=model_utilisateur::getInstance()->findByEmail($sLogin);
                $sHashPassword=model_utlisateur::getInstance()->hashPassword($sPassword);
                $oUtilisateur->password=$sHashPassword;
                if($oUtilisateur->saveModification()){
                    return array('succes' => 'La modification du mot de passe à fonctionné.');
                }else{
                    return $oUtilisateur->getListErrorModification();
                }
                
            }
            
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
            $mail->Host = 'smtp.1and1.com';
            // use
            // $mail->Host = gethostbyname('smtp.gmail.com');
            // if your network does not support SMTP over IPv6

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
            $mail->Port = 25;

            //Set the encryption system to use - ssl (deprecated) or tls
            $mail->SMTPSecure = 'tls';

            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "anthony.rohr@cados.website";

            //Password to use for SMTP authentication
            $mail->Password = "t9Y7wQ4k";

            //Set who the message is to be sent from
            $mail->setFrom('anthony.rohr@cados.website', 'Cados');

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
                  <title align=\"center\">Confirmation Inscription</title>
                </head>
                <body>
                <div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
                  <h1 align=\"center\">Confirmation d'inscription à Cados</h1>
                  <div align=\"center\">
                    <img src=\"http://prod-cados.zapto.org/test.png\" height=\"154\" width=\"320\" alt=\"Cados logo\">
                  </div>
                  <div align=\"center\">
                        <p><font size=\"4\"> Salut " .$sSurname. ", bienvenu sur Cados. Tu viens de t'inscrire sur l'appli web, et pour finaliser tout ça je te propose de confirmer ton inscription. </font></p>
                        <p><font size=\"4\"> Pour cela rien de plus simple, clique sur le liens pour vite nous rejoindre ainsi que toute la communauté. </font></p> 
                        <div align=\"center\">
                            <a href=\"https://cados.website/CadosProject/data/genere/dev-cados/public/index.php?:nav=auth::login&log=$sRecipient&cle=$cle\">
                                <font size=\"6\">Confirmer votre email</font>
                            </a>
                        </div>
                  </div>
                </div>
                </body>
                </html>";
            //<a href=\"https://github.com/PHPMailer/PHPMailer/\"><img src=\"images/phpmailer.png\" height=\"90\" width=\"340\" alt=\"PHPMailer rocks\"></a>
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('/var/www/html/module/auth/view/contents.html'), dirname(__FILE__));
            $mail->isHTML(true);
            $mail->Body = $msgHtml;

            //Replace the plain text body with one created manually
            $mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            //$mail->addAttachment('/var/www/html/dev-cados/CadosProject/data/genere/prod-cados/module/auth/view/Bleu Provence.png');

            $mail->send();
    //		send the message, check for errors
    //		if (!$mail->send()) {
    //		    echo "Mailer Error: " . $mail->ErrorInfo;
    //		} else {
    //		    echo "Message sent!";
    //		}

            }




            private function processInscription(){
                if(!_root::getRequest()->isPost()){
                        return null;
                }

                $tAccount=model_utilisateur::getInstance()->getListAccount();

                $sLogin=_root::getParam('email');
                if(array_key_exists($sLogin, $tAccount)){
                    return array('email' => 'L\'email choisi n\'est pas disponible');
                }
                $sPassword=_root::getParam('password');
                $sConfirmationPassword=_root::getParam('confirmationPassword');
                if(strcmp($sPassword, $sConfirmationPassword) != 0){
                    return array('password' => 'Le mot de passe et la confirmation ne sont pas identiques');
                }
                $sName = _root::getParam('nom');
                $sSurname = _root::getParam('prenom');
                $dBirthday = _root::getParam('date_de_naissance');
                $sAnswer = _root::getParam('answer');

                $oUtilisateur=new row_utilisateur;
                $oUtilisateur->email=$sLogin;
                $oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sPassword);
                $oUtilisateur->nom=$sName;
                $oUtilisateur->prenom=$sSurname;
                $oUtilisateur->date_de_naissance=$dBirthday;
                $oUtilisateur->answer=$sAnswer;
                if($oUtilisateur->save()==false){
                    return $oUtilisateur->getListError();

                }

                $cle = md5(microtime(TRUE)*100000);

                model_utilisateur::getInstance()->setCle($sLogin,$cle);
                $oGroupsUsers=new row_GroupsUsers;
                $oUtilisateurWithId = model_utilisateur::getInstance()->findByEmail($sLogin);
                $oGroupsUsers->users_id = $oUtilisateurWithId->id_utilisateur;
                $oGroupsUsers->groups_id = 4;
                if($oGroupsUsers->save()==false){
                    return $oGroupsUsers->getListError();
                }
                //$this->sendEmailinscription($sLogin,$sName,$sSurname,$cle);
                //Lors d'une inscription on met par defaut l'utilisateur avec un statut utilisateur
                
                //On enregistre dans la table de jointure la question choisie par l'utilisateur
                $tQuestions=model_QuestionSecrete::getInstance()->getSelect();
                $sQuestion = _root::getParam('questionSecrete');
                $iId_question = array_search($sQuestion, $tQuestions);
                $iIdUtilisateur = $oUtilisateurWithId->id_utilisateur;
                $oQuestionsUsers = new row_QuestionsUsers;
                $oQuestionsUsers->id_user=$iIdUtilisateur;
                $oQuestionsUsers->id_question=$iId_question;
                echo '<br><br><br><br><br><br>';
                var_dump($iIdUtilisateur);
                var_dump($iId_question);
                if($oQuestionsUsers->save()==false){
                    return $oQuestionsUsers->getListError();

                }
                
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
