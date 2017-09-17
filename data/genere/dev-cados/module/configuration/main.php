<?php 
class module_configuration extends abstract_module{
	
	public function before(){
            $this->oLayout=new _layout('bootstrap');
            $this->oLayout->addModule('menu','menu::index');
	}
        
        
	public function _profil(){
            $oView=new _view('configuration::profil');
            $oUtilisateur=_root::getAuth()->getAccount();
            $oView->oUtilisateur=$oUtilisateur;
            $this->oLayout->add('main',$oView);
	}
        
        
        public function _modifier(){

            $tMessage=$this->processSave();
		
            $oUtilisateur=_root::getAuth()->getAccount();
            $oView=new _view('configuration::modifier');
            $oView->oUtilisateur=$oUtilisateur;
            $oPluginXsrf=new plugin_xsrf();
            $oView->token=$oPluginXsrf->getToken();
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
        }
        
         private function processSave(){
        
            if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
                    return null;
            }

            $oPluginXsrf=new plugin_xsrf();
            if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
                return array('token'=>$oPluginXsrf->getMessage() );
            }

            $iId=_root::getParam('id',null);
            if($iId==null){
                $oUtilisateur=new row_utilisateur;	
            }else{
                $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id',null) );
            }

            $sPassword=_root::getParam('password',null);
            $sConfirmationPassword=_root::getParam('confirmationPassword',null);
            if($sConfirmationPassword!=null){
                if(strcmp($sPassword, $sConfirmationPassword) != 0){
                    return array('password' => 'Le mot de passe et la confirmation ne sont pas identiques');
                }
            }

            $tColumn=array('nom','prenom','date_de_naissance','numero','email','pseudo');
            foreach($tColumn as $sColumn){
                $oUtilisateur->$sColumn=_root::getParam($sColumn,null) ;
            }

            $oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sPassword);

            if($oUtilisateur->saveModification()){
                //une fois enregistre on redirige (vers la page profil)
                _root::getAuth()->setAccount($oUtilisateur);
                _root::redirect('configuration::profil');
            }else{
                return $oUtilisateur->getListErrorModification();
            }

        }
        
        public function _modifierPassword(){

            $tMessage=$this->processSavePassword();
		
            $oUtilisateur=_root::getAuth()->getAccount();
            $oView=new _view('configuration::modifierPassword');
            $oView->oUtilisateur=$oUtilisateur;
            $oView->tId=model_utilisateur::getInstance()->getIdTab();

            $oPluginXsrf=new plugin_xsrf();
            $oView->token=$oPluginXsrf->getToken();
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
            
        }
        
        private function processSavePassword(){
        
            if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
                    return null;
            }

            $oPluginXsrf=new plugin_xsrf();
            if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
                return array('token'=>$oPluginXsrf->getMessage() );
            }

            $tMessage = array();
            $oUtilisateur = _root::getAuth()->getAccount();
            
            $sPassword=_root::getParam('password');
            $sHashPassword=model_utilisateur::getInstance()->hashPassword($sPassword);
            $sEmail=$oUtilisateur->email;
            $sNewPassword=_root::getParam('newPassword');
            $sConfirmationPassword=_root::getParam('confirmationPassword');
            $tAccount=model_utilisateur::getInstance()->getListAccount();

            if(!_root::getAuth()->checkLoginPass($tAccount,$sEmail,$sHashPassword)){
                $tMessage['password'] = 'L\'ancien password ne correspond pas';
            }
            if(empty($sPassword)){
                $tMessage['password'] = 'Le mot de passe ne doit pas être vide';
            }
            if(empty($sNewPassword)){
                $tMessage['newPassword'] = 'Le nouveau mot de passe ne doit pas être vide';
            }
            if(empty($sConfirmationPassword)){
                $tMessage['confirmationPassword'] = 'La confirmation du nouveau mot de passe ne doit pas être vide';
            }
            if(strcmp($sNewPassword, $sConfirmationPassword) != 0){
                $tMessage['newPassword'] = 'Le nouveau mot de passe et la confirmation ne sont pas identiques';
            }

            if(!empty($tMessage)){
                return $tMessage;
            }else{
                $oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sNewPassword);
                if($oUtilisateur->save()){
                    //une fois enregistre on redirige (vers la page profil)
                    _root::getAuth()->setAccount($oUtilisateur);
                    _root::redirect('configuration::profil');
                }else{
                    return $oUtilisateur->getListErrorModification();
                }   
            }
            

        }
        
        public function _modifierPhoto(){
            
            $oUtilisateur = _root::getAuth()->getAccount();
            $tMessage = $this->checkUpload($oUtilisateur);
            $oView=new _view('configuration::modifierPhoto');
            $oView->oUtilisateur=$oUtilisateur;
            $oPluginXsrf=new plugin_xsrf();
            $oView->token=$oPluginXsrf->getToken();
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
            
        }

        private function checkUpload($oUtilisateur){

            if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
                return null;
            }
            $sColumn='profilPicture';
            $oPluginUpload=new plugin_upload($sColumn);

            if($oPluginUpload->isValid()){
               $sNewFileName='css/images/profil/'.$sColumn.'_'.date('Ymdhis');

               $oPluginUpload->saveAs($sNewFileName);
               $oUtilisateur->profilPicture=$oPluginUpload->getPath();

               $oUtilisateur->save();
               _root::getAuth()->setAccount($oUtilisateur);
            }

        }

        public function _rappel(){
            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
            if(!$oUtilisateur){
                 $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                 $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
            }
            $oView=new _view('configuration::rappel');
            $oView->oUtilisateur=$oUtilisateur;



            $this->oLayout->add('main',$oView);
        }


        public function _help(){
            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
            if(!$oUtilisateur){
                 $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                 $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
            }
            $oView=new _view('configuration::help');
            $oView->oUtilisateur=$oUtilisateur;



            $this->oLayout->add('main',$oView);
        }

        public function after(){
            $this->oLayout->show();
        }
	
	
}
