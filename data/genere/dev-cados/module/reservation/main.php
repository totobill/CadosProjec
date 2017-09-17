<?php 
class module_reservation extends abstract_module{
	
        public function before(){
                $this->oLayout=new _layout('bootstrap');

                $this->oLayout->addModule('menu','menu::index');
        }
	
	
        public function _reserver(){
            $oUtilisateur = _root::getAuth()->getAccount();
            $tMessage = $this->checkNumeroReservation();
            
            //Si l'utilisateur n'a pas encore de casier
            if($oUtilisateur->id_bouton == 0){
                //Si l'utilisateur réserver un casier, alors on redirige.
                if(isset($tMessage) and isset($tMessage['success'])){
                    _root::redirect('reservation::utilisation');

                }else{ //Si l'utilisateur arrive pour la première fois sur la page de réservation ou essaie de réserver un casier hors délais.
                   $oView = new _view('reservation::reserver');
                   $this->oLayout->add('main',$oView);
                   $oCasier = model_casier::getInstance()->findAll();
                   $oView->oCasier=$oCasier;
                   $oView->tMessage = $tMessage;
                }
            } else { //Si l'utilisateur à déjà un casier
                _root::redirect('reservation::utilisation');
            }
            
        }
        
        public function _utilisation(){
            $oUtilisateur = _root::getAuth()->getAccount();
            $oCasier = model_casier::getInstance()->findById($oUtilisateur->id_bouton);
            $sMessage = $this->checkBoutonUtilisation();
            if(isset($sMessage)){
                if(strcmp($sMessage,'ouvrir') == 0){
                    $tMessage = $this->ouvertureCasier();
                    echo '<br><br><br><br><br><br>';
                    var_dump($tMessage);
                }elseif(strcmp($sMessage,'vider') == 0){
                    $tMessage = $this->viderCasier();
                    echo '<br><br><br><br><br><br>';
                    var_dump($tMessage);
                    if(isset($tMessage['success'])){
                        _root::redirect('reservation::reserver');
                    }
                    
                }
            }else{
                $tMessage = array('resultat' => '');
            }
            $oView = new _view('reservation::utilisation');
            $this->oLayout->add('main',$oView);
            $oView->tMessage = $tMessage;
            $oView->oCasier = $oCasier;
            
        }
        
//	public function _reserver(){
//            
//                $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
//                $sMessage = '';
//                
//                //On regarde si l'utilisateur clique sur le bouton ouvrir/vider
//                $returnValue = $this->checkButtonUtilisation();
//                
//                //Si l'utilisation a déjà réserver un casier et a taper sur un des deux boutons.
//                if(isset($returnValue)){
//                    //Si l'utilisateur à taper sur Ouvrir :
//                    if($returnValue == 'ouvrir'){
//                        $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
//                        $bMessage = $this->ouvertureCasier($id_bouton);
//                        if($bMessage == TRUE){ // l'ouverture s'est bien passée
//                            $sMessage = 'l\'ouverture s\'est bien passée.';
//                            
//                        }else { // l'ouverture s'est mal passé
//                            $sMessage = 'L\'ouverture du casier n\a pas fonctionée. Contactez un admin sur site.'; 
//
//                        }
//                        
//                        $oView=new _view('reservation::utilisation');
//                        $this->oLayout->add('main',$oView);
//                        $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
//                        $oCasier = model_casier::getInstance()->findById($oUtilisateur->id_bouton);
//                        $oView->sMessage=$sMessage;
//                        $oView->infoReservation=$oUtilisateur;
//                        $oView->oCasier=$oCasier;
//                    //Si l'utilisateur à taper sur Vider :
//                    }else if($returnValue == 'vider'){
//                        $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
//                        $bMessage = $this->viderCasier($id_bouton, $iIdUtilisateur);
//                        if($bMessage == TRUE){
//                            $sMessage = 'l\'ouverture s\'est bien passée.';
//                            $oView=new _view('reservation::reserver');
//                            $this->oLayout->add('main',$oView);
//                            $oCasier = model_casier::getInstance()->findAll();
//                            $oView->oCasier=$oCasier;
//                        }else{
//                            $sMessage = 'Vider le casier n\'a pas fonctionée. Contactez un admin sur site.';
//                            $oView=new _view('reservation::utilisation');
//                            $this->oLayout->add('main',$oView);
//                            $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
//                            $oCasier = model_casier::getInstance()->findById($oUtilisateur->id_bouton);
//                            $oView->infoReservation=$oUtilisateur;
//                            $oView->sMessage=$sMessage;
//                            $oView->oCasier=$oCasier;
//                        }
//                        
//                    }
//                //Si l'utilisateur n'a pas taper sur l'un des deux boutons.
//                }else{
//
//                    //On regarde si l'utilisateur à déjà réserver un casier
//                    // Si oui on afficher alors son casier réservé avec les informations
//                    // relartives à sa réservation. Si non on affiche l'ensemble des casiers.
//                    $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
//                    if($id_bouton != 0){
//                        $oCasier=model_casier::getInstance()->findById($id_bouton);
//                        $oView=new _view('reservation::utilisation');
//                        $this->oLayout->add('main',$oView);
//                        $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
//                        $oView->infoReservation=$oUtilisateur;
//                        $oView->sMessage=$sMessage;
//                        $oView->oCasier=$oCasier;
//                    }else{
//                        //On vérifie si l'utilisateur à
//                        //soumis un choix de réservation d'un casier, si oui on le réserve
//                        //si non on affiche l'ensemble des casiers.
//                        $bReserv = $this->checkNumeroReservation();
//                        
//                        if($bReserv != null){
//                            if($bReserv){
//                                $oCasier=model_casier::getInstance()->findById((int)_root::getParam('num_bouton'));
////                              $dStartReservation = date("Y-m-d H:i:s"); //format date time de mysql
//                                $dStartReservation = new DateTime('now Europe/Paris');
//                                $dStartReservation = $dStartReservation->format('Y-m-d H:i:s');
//                                $dEndReservation = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
//                                $oCasier->start_location=$dStartReservation;
//                                $oCasier->end_location=$dEndReservation;
//                                $oCasier->save();
//
//                                $oView=new _view('reservation::utilisation');
//                                $this->oLayout->add('main',$oView);
//                                $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
//                                $oView->infoReservation=$oUtilisateur;
//                                $oView->sMessage=$sMessage;
//                                $oView->oCasier=$oCasier;
//                                
//                            }else{
//                                $oView=new _view('reservation::reserver');
//                                $this->oLayout->add('main',$oView);
//                                $oCasier = model_casier::getInstance()->findAll();
//                                $oView->oCasier=$oCasier;
//                                $oView->tMessage=array('date_limite'=>'Vous ne pouvez pas réserver un casier après 18h, l\'heure de fermeture de l\'établissement');
//                            }
//                        }else{
//                            $oView=new _view('reservation::reserver');
//                            $this->oLayout->add('main',$oView);
//                            $oCasier = model_casier::getInstance()->findAll();
//                            $oView->oCasier=$oCasier;
//                            $oView->tMessage=array();
//                        }            
//                    }
//                }
//        }
	
        
        public function ouvertureCasier(){
//            $requete = "python /var/www/html/dev-cados/CadosProject/Casiers/ouverture2.py $iNumCasier";
            $oUtilisateur = _root::getAuth()->getAccount();
            $requete = "python /kunden/homepages/46/d675115566/htdocs/CadosProject/data/genere/dev-cados/Casiers/ouverture2.py $oUtilisateur->id_bouton";
            $resultat = trim(shell_exec($requete));
            echo '<br><br><br><br><br>';
            var_dump($resultat);
            if(strcmp($resultat,'casier ouvert') == 0){
                return array('resultat' => 'Le casier s\'est correctement ouvert');
            }else if (strcmp($resultat,'probleme ouverture casier') == 0){
                return array('resultat' => 'Il y a eu un problème avec l\'ouverture du casier, contactez un administrateur');
            }
        }
        
        public function viderCasier(){
//            $requete = "python /var/www/html/dev-cados/CadosProject/Casiers/ouverture2.py $iNumCasier";
            $oUtilisateur = _root::getAuth()->getAccount();
            $requete = "python /kunden/homepages/46/d675115566/htdocs/CadosProject/data/genere/dev-cados/Casiers/ouverture2.py $oUtilisateur->id_bouton";
            $resultat = trim(shell_exec($requete));

            if($resultat == 'casier ouvert'){
                
                $oCasier = model_casier::getInstance()->findById($oUtilisateur->id_bouton);
                
                $oUtilisateur->id_bouton = 0;
                $oUtilisateur->save();
                _root::getAuth()->setAccount($oUtilisateur);
                
                $oCasier->start_location = null;
                $oCasier->end_location = null;
                $oCasier->etat = 0;
                $oCasier->id_utilisateur = 0;
                $oCasier->save();
                return array('success' => '');
            }else if ($resultat == 'probleme ouverture casier'){
                return array('resultat' => 'Il y a eu un problème pour vider le casier, contactez un administrateur');
            }
        }
        
        public function checkBoutonUtilisation(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }
            $sOuvrir = _root::getParam('ouvrir');
            $sVider = _root::getParam('vider');

            if(isset($sOuvrir)){
                return 'ouvrir';
            }else if (isset($sVider)){
                return 'vider';
            }
            
        }
        
        public function checkNumeroReservation(){
            //si le formulaire n'est pas envoye on s'arrete la
            if(!_root::getRequest()->isPost() ){
                    return null;
            }

            $iIdCasier=(int)_root::getParam('num_bouton');
            $dNow = new DateTime('now Europe/Paris');
            $dNow_regler = $dNow->format('Y-m-d H:i:s');
            $dLimite = date("Y-m-d H:i:s", mktime(18,0,0,date("m"),date("d"),date("Y")));
            if($dNow_regler < $dLimite){
                $oUtilisateur = _root::getAuth()->getAccount();
                $oUtilisateur->id_bouton = $iIdCasier;
                $oUtilisateur->save();
                _root::getAuth()->setAccount($oUtilisateur);
                
                $oCasier = model_casier::getInstance()->findById($iIdCasier);
                $oCasier->start_location = $dNow_regler;
                $oCasier->end_location = $dLimite;
                $oCasier->etat = 1;
                $oCasier->id_utilisateur = $oUtilisateur->id_utilisateur;
                $oCasier->save();
                
//                $id_utilisateur =(int)_root::getAuth()->getAccount()->id_utilisateur;
//                model_casier::getInstance()->setEtat1($iIdCasier,$id_utilisateur);
//                model_utilisateur::getInstance()->setIdBouton($iIdCasier,$id_utilisateur);    
                return array('success' => '');
            }else{
                return array('date_limite' => 'Vous ne pouvez pas réserver un casier après 18h, l\'heure de fermeture de l\'établissement');
            } 
        }
//	public function _utilisation(){
//		$oView=new _view('reservation::utilisation');
//		$this->oLayout->add('main',$oView);
//	}
			
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}
