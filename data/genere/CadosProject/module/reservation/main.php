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
                            $sMessage = 'l\'ouverture s\'est bien passée. 1';
                            
                        }else { // l'ouverture s'est mal passé
                            $sMessage = 'L\'ouverture du casier n\a pas fonctionée. Contactez un admin sur site. 2 Bonjoru'; 

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
                            $sMessage = 'l\'ouverture s\'est bien passée. 3';
                            $oView=new _view('reservation::reserver');
                            $this->oLayout->add('main',$oView);
                            $oCasier = model_casier::getInstance()->findAll();
                            $oView->oCasier=$oCasier;
                        }else{
                            $sMessage = 'L\'ouverture du casier n\a pas fonctionée. Contactez un admin sur site. 4';
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
                    // relartves à sa réservation. Si non on affiche l'ensemble des casiers.
                    $id_bouton = model_utilisateur::getInstance()->getId_Bouton($iIdUtilisateur);
                    if($id_bouton != 0){
                        $oView=new _view('reservation::utilisation');
                        $this->oLayout->add('main',$oView);
                        $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                        $oView->infoReservation=$oUtilisateur;
                        $oView->sMessage=$sMessage;
                    }else{
                        //On vérifie si l'utilisateur à
                        //soumis un choix de réservation d'un casier, si oui on le réserve
                        //si non on affiche l'ensemble des casiers.
                        $bReservation = $this->checkNumeroReservation(); 
                        if($bReservation){
                            $oView=new _view('reservation::utilisation');
                            $this->oLayout->add('main',$oView);
                            $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
                            $oView->infoReservation=$oUtilisateur;
                            $oView->sMessage=$sMessage;
                        }else{
                            $oView=new _view('reservation::reserver');
                            $this->oLayout->add('main',$oView);
                            $oCasier = model_casier::getInstance()->findAll();
                            $oView->oCasier=$oCasier;
                        }
                        
                        
                        
                        
                    }
                }
        }
	
        public function ouvertureCasier($iNumCasier){
            $requete = "python /var/www/html/Casiers/ouverture2.py $iNumCasier";
            $resultat = system($requete);
            if($resultat == 'casier ouvert'){
                return TRUE;
            }else if ($resultat == 'probleme ouverture casier'){
                return FALSE;
            }
        }
        
        public function viderCasier($iNumCasier,$iIdutilisateur){
            $requete = "python /var/www/html/Casiers/ouverture2.py $iNumCasier";
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
            $id_utilisateur =(int)_root::getAuth()->getAccount()->id_utilisateur;
            model_casier::getInstance()->setEtat1($iIdCasier,$id_utilisateur);
            model_utilisateur::getInstance()->setIdBouton($iIdCasier,$id_utilisateur);
            if(isset($iIdCasier)){
				return TRUE;
			}else{
				return FALSE;
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
