<?php 
class module_reservation extends abstract_module{
	
        public function before(){
                $this->oLayout=new _layout('bootstrap');

                $this->oLayout->addModule('menu','menu::index');
        }
	
	
	public function _reserver(){
            
                $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
                $sMessage = '';
                
                //On regarde si l'utilisateur clique sur le bouton ouvrir/vider
                $returnValue = $this->checkButtonUtilisation();
                
                //Si l'utilisation a déjà réserver un casier et a taper sur un des deux boutons.
                if(isset($returnValue)){
                    //Si l'utilisateur à taper sur Ouvrir :
                    if($returnValue == 'ouvrir'){
                        $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
                        $bMessage = $this->ouvertureCasier($id_bouton);
                        if($bMessage == TRUE){ // l'ouverture s'est bien passée
                            $sMessage = 'l\'ouverture s\'est bien passée.';
                            
                        }else { // l'ouverture s'est mal passé
                            $sMessage = 'L\'ouverture du casier n\a pas fonctionée. Contactez un admin sur site.'; 

                        }
                        
                        $oView=new _view('reservation::utilisation');
                        $this->oLayout->add('main',$oView);
                        $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                        $oView->sMessage=$sMessage;
                        $oView->infoReservation=$oUtilisateur;
                    //Si l'utilisateur à taper sur Vider :
                    }else if($returnValue == 'vider'){
                        $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
                        $bMessage = $this->viderCasier($id_bouton, $iIdUtilisateur);
                        if($bMessage == TRUE){
                            $sMessage = 'l\'ouverture s\'est bien passée.';
                            $oView=new _view('reservation::reserver');
                            $this->oLayout->add('main',$oView);
                            $oCasier = model_casier::getInstance()->findAll();
                            $oView->oCasier=$oCasier;
                        }else{
                            $sMessage = 'L\'ouverture du casier n\a pas fonctionée. Contactez un admin sur site.';
                            $oView=new _view('reservation::utilisation');
                            $this->oLayout->add('main',$oView);
                            $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                            $oView->infoReservation=$oUtilisateur;
                            $oView->sMessage=$sMessage;
                        }
                        
                    }
                //Si l'utilisateur n'a pas taper sur l'un des deux boutons.
                }else{

                    //On regarde si l'utilisateur à déjà réserver un casier
                    // Si oui on afficher alors son casier réservé avec les informations
                    // relartives à sa réservation. Si non on affiche l'ensemble des casiers.
                    $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
                    if($id_bouton != 0){
                        $oCasier=model_casier::getInstance()->findById($id_bouton);
                        $oView=new _view('reservation::utilisation');
                        $this->oLayout->add('main',$oView);
                        $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                        $oView->infoReservation=$oUtilisateur;
                        $oView->sMessage=$sMessage;
                        $oView->oCasier=$oCasier;
                    }else{
                        //On vérifie si l'utilisateur à
                        //soumis un choix de réservation d'un casier, si oui on le réserve
                        //si non on affiche l'ensemble des casiers.
                        $bReserv = $this->checkNumeroReservation();
                        $iIdCasier=(int)_root::getParam('num_bouton');
                      echo "<br><br><br><br><br><br>";
////                        var_dump($iIdCasier);
//			var_dump($tMessage);
			var_dump('ceci est un test');
			var_dump($bReserv);
                        $dStartReservation = new DateTime('now Europe/Paris');
                        var_dump($dStartReservation);
                        $dEndReservation = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
                        var_dump($dEndReservation);
                        if($bReserv != null){
                            if($bReserv){
                                $oCasier=model_casier::getInstance()->findById((int)_root::getParam('num_bouton'));
//                            $dStartReservation = date("Y-m-d H:i:s"); //format date time de mysql
                                echo "Je veux savoir si la valeur de empty(tmessage) est bien vide";
                                var_dump(empty($tMessage));
                                $dStartReservation = new DateTime('now Europe/Paris')->;
                                var_dump($dStartReservation);
                                $dEndReservation = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
                                $oCasier->start_location=$dStartReservation;
                                $oCasier->end_location=$dEndReservation;
                                $oCasier->save();

                                $oView=new _view('reservation::utilisation');
                                $this->oLayout->add('main',$oView);
                                $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                                $oView->infoReservation=$oUtilisateur;
                                $oView->sMessage=$sMessage;
                                $oView->oCasier=$oCasier;
                            }else{
                                $oView=new _view('reservation::reserver');
                                $this->oLayout->add('main',$oView);
                                $oCasier = model_casier::getInstance()->findAll();
                                $oView->oCasier=$oCasier;
                                $oView->tMessage=array('date_limite'=>'Vous ne pouvez pas réserver un casier après 18h, l\'heure de fermeture de l\'établissement');
                            }
                        }else{
                            $oView=new _view('reservation::reserver');
                            $this->oLayout->add('main',$oView);
                            $oCasier = model_casier::getInstance()->findAll();
                            $oView->oCasier=$oCasier;
                            $oView->tMessage=array();
                        }
//			} else if(empty($tMessage)){
//                            $oCasier=model_casier::getInstance()->findById((int)_root::getParam('num_bouton'));
////                            $oCasier=model_casier::getInstance()->findById(5);
////                            $dStartReservation = date("Y-m-d H:i:s"); //format date time de mysql
//                            echo "Je veux savoir si la valeur de empty(tmessage) est bien vide";
//			    var_dump(empty($tMessage));
//			    $dStartReservation = new DateTime('now Europe/Paris');
//			    var_dump($dStartReservation);
//                            $dEndReservation = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
//                            $oCasier->start_location=$dStartReservation;
//                            $oCasier->end_location=$dEndReservation;
//                            $oCasier->save();
//                            
//                            
////                            var_dump($tMessage);
////                            var_dump($dStartReservation);
////                            var_dump($oCasier);
////                            var_dump((int)_root::getParam('num_bouton'));
//                            $oView=new _view('reservation::utilisation');
//                            $this->oLayout->add('main',$oView);
//                            $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
//                            $oView->infoReservation=$oUtilisateur;
//                            $oView->sMessage=$sMessage;
//                            $oView->oCasier=$oCasier;
//                        }else{
//                            $oView=new _view('reservation::reserver');
//                            $this->oLayout->add('main',$oView);
//                            $oCasier = model_casier::getInstance()->findAll();
//                            $oView->oCasier=$oCasier;
//                            $oView->tMessage=$tMessage;
//                        }               
                    }
                }
        }
	
        public function ouvertureCasier($iNumCasier){
            $requete = "python /var/www/html/dev-cados/CadosProject/Casiers/ouverture2.py $iNumCasier";
            $resultat = system($requete);
            if($resultat == 'casier ouvert'){
                return TRUE;
            }else if ($resultat == 'probleme ouverture casier'){
                return FALSE;
            }
        }
        
        public function viderCasier($iNumCasier,$iIdutilisateur){
            $requete = "python /var/www/html/dev-cados/CadosProject/Casiers/ouverture2.py $iNumCasier";
            $resultat = system($requete);
            if($resultat == 'casier ouvert'){
                model_casier::getInstance()->setEtat0($iNumCasier);
                model_utilisateur::getInstance()->setIdBouton0($iIdutilisateur);
                return TRUE;
            }else if ($resultat == 'probleme ouverture casier'){
                return FALSE;
            }
        }
        
        public function checkButtonUtilisation(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }
            $test1 = _root::getParam('ouvrir');
            $test2 = _root::getParam('vider');
            $buttonOuvrir = isset($test1);
            $buttonVider = isset($test2);
            if($buttonOuvrir){
                return 'ouvrir';
            }else if ($buttonVider){
                return 'vider';
            }
            
        }
        
        public function checkNumeroReservation(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }

            $iIdCasier=(int)_root::getParam('num_bouton');
            $dNow = date("Y-m-d H:i:s");
            $dLimite = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
//            echo "<br><br><br><br><br>";
//            var_dump($dNow > $dLimite);
//	    var_dump('AHAHAHAHA');
            if(!(isset($iIdCasier)) && ($dNow < $dLimite)){
                $id_utilisateur =(int)_root::getAuth()->getAccount()->id_utilisateur;
                model_casier::getInstance()->setEtat1($iIdCasier,$id_utilisateur);
                model_utilisateur::getInstance()->setIdBouton($iIdCasier,$id_utilisateur);    
               
               
//                if($dNow > $dLimite){
//                    return array('date_limite'=>'Vous ne pouvez pas réserver un casier après 18h, l\'heure de fermeture de l\'établissement');
//                }else{
//                    return array();
//                }
                return true;
            }else{
//                return array('date_limite'=>'Vous ne pouvez pas réserver un casier après 18h, l\'heure de fermeture de l\'établissement');
                return false;
            }
            //_root::redirect('reservation::utilisation');

            
        }
	public function _utilisation(){
	
		$oView=new _view('reservation::utilisation');
		
		$this->oLayout->add('main',$oView);
	}
			
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}
