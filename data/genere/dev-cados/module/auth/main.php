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
                    _root::getLog()->log("L\'utilisateur $email à essayer d'activer une deuxième son compte.");
                    $sConfirmation = "Vous avez déjà confirmé votre compte.";
                } else {
                    if($aConfirmation->cle != $cle){
                        _root::getLog()->log("L\'utilisateur $email n'a pas pu acitiver son compte. La clé fournie n'est pas la bonne.");
                        $sConfirmation = "Erreur. Votre compte ne peux pas être activé, la clé fournie n'est pas correcte.";
                    }else{
                        _root::getLog()->log("L'utilisateur $email à activer son compte");
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
            
            if(_root::getParam('log')){$oView->sEmail=$email;}
            $oView->sConfirmation=$sConfirmation;
            
            if(isset($_SESSION['tMessage'])){
                $oView->tMessage = $_SESSION['tMessage'];
                unset($_SESSION['tMessage']);
            }
            
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
                    _root::getLog()->log("L'utilisateur $sLogin à essayé de s'identifier avec un password trop long, len max = 100");
                    return 'Mot de passe trop long';
		}
		
		//on stoque les mots de passe hashe dans la classe model_utilisateur
		$sHashPassword=model_utilisateur::getInstance()->hashPassword($sPassword);
		$tAccount=model_utilisateur::getInstance()->getListAccount();
		
		//on va verifier que l'on trouve dans le tableau retourne par notre model
		//l'entree $tAccount[ login ][ mot de passe hashe ]
		if(!_root::getAuth()->checkLoginPass($tAccount,$sLogin,$sHashPassword)){
                    _root::getLog()->log("L'utilisateur $sLogin n'a pas réussi à s'identifier, le mot de passe ou le login ne sont pas corrects.");
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
                        _root::getLog()->log("L'utilisateur $sLogin n'a pas pu se connecter car il n'a pas validé son compte.");
                        return 'Veuillez confirmer votre email pour pouvoir vous connecter.';
                    } 
                }       
		_root::getLog()->log("L'utilisateur $sLogin vient de se connecter avec succès");
		_root::redirect('default::index');
                
                

//                _root::redirect('privatemodule_action');
                /*pour accéder à l'administration des droits*/
                // index.php?:nav=rightsManagerMulti::index
	}

        public function _inscription(){
            $tMessage=$this->processInscription();
            if(isset($tMessage) and array_key_exists('success', $tMessage)){
                $_SESSION['tMessage'] = $tMessage;
                $inscriptionLog = 'L\'utilisateur : ' . _root::getParam('email') . ' vient de s\'inscrire.';
                _root::getLog()->log($inscriptionLog);
                _root::redirect('auth::login');
            }else{
                $oView=new _view('auth::inscription');
                $tQuestions=model_QuestionSecrete::getInstance()->getSelect();
                $oView->tQuestions=$tQuestions;
            }
            $oView->tMessage=$tMessage;
            
            $oView->oUser=new row_utilisateur;

            $this->oLayout->add('main',$oView);
        }
        
        public function _forgotPassword(){
            $tMessage = $this->checkEmail();
            $oView = new _view('auth::forgotPassword');
            $oView->tMessage = $tMessage;
            $oView->oUtilisateur= new row_utilisateur;
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
               _root::getLog()->log("$sLogin essai de réinitialiser son password mais l'adresse n'existe pas en bdd.");
               return array('email' => "L'adresse email fourni n'existe pas.");
           //Si elle existe, alors on renvoie un message de succès.
           }else{
               $sNewPassword = uniqid();
               $sNewPasswordHash = model_utilisateur::getInstance()->hashPassword($sNewPassword);
               $oUtilisateur = model_utilisateur::getInstance()->findByEmail($sLogin);
               $oUtilisateur->password = $sNewPasswordHash;
               if($oUtilisateur->save()==false){
                    return $oUtilisateur->getListError();
               }
               if($this->sendMailOneAndOneForgotPassword($sNewPassword,$sLogin)){
                   return array('success' => "Un email contenant un nouveau mot de passe vous a été envoyé, si vous n'avez pas reçu d'email, contactez un administrateur.");
               }else{
                   return array('email' => "L'envoie de l'email n'a pas fonctioné, merci de contacter un administrateur");
               }
           }
        }
        
        public function sendMailOneAndOneForgotPassword($sNewPassword,$sRecipient){

            $to  = $sRecipient;
            $subject = 'Réinitilisation mot de passe';
            $sMessage = "
                    <html>
                    <head>
                      <title align=\"center\">Nouveau mot de passe</title>
                    </head>
                    <body>
                    <div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
                      <h1 align=\"center\">Nouveau mot de passe</h1>
                      <div align=\"center\">
                        <img src=\"https://cados.website/CadosProject/data/genere/dev-cados/public/css/images/Rouge.png\" height=\"154\" width=\"320\" alt=\"Cados logo\">
                      </div>
                      <div align=\"center\">
                            <p><font size=\"4\">Tu as demandé de réinitilisé ton mot de passe. Nous avons générer un nouveaut mot de passe pour que tu puisses de nouveau te connecter, le voici :</font></p>
                            <p><font size=\"5\">Nouveau mot de passe : $sNewPassword</font></p>
                            <p><font size=\"4\">N'oubli pas de modifier ton mot de passe dans ton profil.</font></p> 
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
                _root::getLog()->log("L'utilisateur $to à demandé une réinitialisation du mdp. Un mail contenant un nouveau mdp lui a été envoyé.");
                return true;
            }else{
                _root::getLog()->log("L'utilisateur $to à demandé une réinitialisation du mdp. Le mail contenant le nouveau mdp n'a pas été envoyé à cause d'un problème.");
                return false;
            }
        }
        
        
        public function sendMailOneAndOneInscription($sRecipient,$sSurname,$cle){
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $sRecipient)){
                $passage_ligne = "\r\n";
            }else{
                $passage_ligne = "\n";
            }
            
            $to  = $sRecipient;
            $subject = 'Confirmation inscription Cados';
            $sMessage = "
                    <html>
                        <head>
                         <title align=\"center\">Confirmation Inscription</title>
                        </head>
                        <body>
                        <div style=\"width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
                          <h1 align=\"center\">Confirmation d'inscription à Cados</h1>
                          <div align=\"center\">
                            <img src=\"https://cados.website/CadosProject/data/genere/dev-cados/public/css/images/Rouge.png\" height=\"154\" width=\"320\" alt=\"Cados logo\">
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

            // En-têtes additionnels
            //  // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
            $headers  = 'MIME-Version: 1.0' . $passage_ligne;
            $headers .= 'Content-type: text/html; charset=iso-8859-1' .$passage_ligne;
//            $headers .= 'To: Test <'. $sRecipient . ">\r\n";
            $headers .= 'From: "TeamCados" <anthony.rohr@cados.website>' . $passage_ligne;
            $headers .= 'Reply-To: "Admin" <cados.development@gmail.com>'. $passage_ligne;
//            $headers .= 'Bcc: anniversaire_verif@example.com' . "\r\n";
            

            if(mail($to, $subject, $sMessage, $headers)){
                _root::getLog()->log("Un email de confirmation d'inscription à été envoyé à $to.");
                return true;
            }else{
                _root::getLog()->log("L'envoie de l'email de confirmation à $to à échoué.");
                return false;
            }
        }
        
        public function sendEmail($sRecipient){
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
            $mail->addAddress($sRecipient);
            
            //Set the subject line
            $mail->Subject = '';
            
            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            //$mail->msgHTML(file_get_contents('/var/www/html/module/auth/view/contents.html'), dirname(__FILE__));
            $mail->isHTML(true);
            $mail->Body = '';

            //Replace the plain text body with one created manually
            $mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            //$mail->addAttachment('/var/www/html/dev-cados/CadosProject/data/genere/prod-cados/module/auth/view/Bleu Provence.png');
            return $mail;
        }
        
        public function sendEmailinscription($sRecipient,$sSurname,$cle){
            $mail = $this->sendEmail($sRecipient);
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

            $mail->Body = $msgHtml;

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
                
                
                //Lors d'une inscription on met par defaut l'utilisateur avec un statut utilisateur
                
                //On enregistre dans la table de jointure la question choisie par l'utilisateur
                $iIdQuestion = _root::getParam('questionSecrete');
                $iIdUtilisateur = $oUtilisateurWithId->id_utilisateur;
                $oQuestionsUsers = new row_QuestionsUsers;
                $oQuestionsUsers->id_user=$iIdUtilisateur;
                $oQuestionsUsers->id_question=$iIdQuestion;

                if($oQuestionsUsers->save()==false){
                    return $oQuestionsUsers->getListError();

                }
                //$this->sendEmailinscription($sLogin,$sSurname,$cle);
                if(!$this->sendMailOneAndOneInscription($sLogin,$sSurname,$cle)){
                    return array('success'=>array("Il y a eu un problème avec l'envoie d'email"));
                }else{
                    return array('success'=>array("Votre compte a bien été créé. Veuillez confirmer votre compte, un email vous a été envoyé."));
                }
                

            }

            public function _logout(){
                $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
                $sLogin = _root::getAuth()->getAccount()->email;
                model_utilisateur::getInstance()->setConnecte0($iIdUtilisateur);		
                _root::getLog()->log("$sLogin s'est déconnecté.");
                _root::getAuth()->logout();
            }

            public function after(){
                $this->oLayout->show();
            }
}
