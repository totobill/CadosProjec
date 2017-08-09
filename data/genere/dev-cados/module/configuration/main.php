<?php 
class module_configuration extends abstract_module{
	
	public function before(){
            $this->oLayout=new _layout('bootstrap');
            $this->oLayout->addModule('menu','menu::index');
	}
        
	public function _profil(){
            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
            if(!$oUtilisateur){
                 $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                 $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
            }
            $oView=new _view('configuration::profil');
            $oView->oUtilisateur=$oUtilisateur;



            $this->oLayout->add('main',$oView);
	}
        
        public function _modifier(){

            $tMessage=$this->processSave();
		
            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
            if(!$oUtilisateur){
                 $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                 $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
            }
            $oView=new _view('configuration::modifier');
            $oView->oUtilisateur=$oUtilisateur;
            $oView->tId=model_utilisateur::getInstance()->getIdTab();



            $oPluginXsrf=new plugin_xsrf();
            $oView->token=$oPluginXsrf->getToken();
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
        }
        
        public function _modifierPassword(){

            $tMessage=$this->processSave();
		
            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
            if(!$oUtilisateur){
                 $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                 $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
            }
            $oView=new _view('configuration::modifierPassword');
            $oView->oUtilisateur=$oUtilisateur;
            $oView->tId=model_utilisateur::getInstance()->getIdTab();



            $oPluginXsrf=new plugin_xsrf();
            $oView->token=$oPluginXsrf->getToken();
            $oView->tMessage=$tMessage;
            
            $this->oLayout->add('main',$oView);
            
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
            _root::redirect('configuration::profil');
        }else{
            return $oUtilisateur->getListErrorModification();
        }

    }
    
//    private function processSavePassword(){
//        
//        if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
//                return null;
//        }
//
//        $oPluginXsrf=new plugin_xsrf();
//        if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
//            return array('token'=>$oPluginXsrf->getMessage() );
//        }
//
//        $iId=_root::getParam('id',null);
//        if($iId==null){
//            $oUtilisateur=new row_utilisateur;	
//        }else{
//            $oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id',null) );
//        }
//        
//        $sPassword=_root::getParam('password',null);
//        $sConfirmationPassword=_root::getParam('confirmationPassword',null);
//        if(strcmp($sPassword, $sConfirmationPassword) != 0){
//            return array('password' => 'Le mot de passe et la confirmation ne sont pas identiques');
//        }
//        
//        $tColumn=array('nom','prenom','date_de_naissance','numero','email','pseudo');
//        foreach($tColumn as $sColumn){
//            $oUtilisateur->$sColumn=_root::getParam($sColumn,null) ;
//        }
//
//        $oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sPassword);
//        
//        if($oUtilisateur->saveModification()){
//            //une fois enregistre on redirige (vers la page profil)
//            _root::redirect('configuration::profil');
//        }else{
//            return $oUtilisateur->getListErrorModification();
//        }
//
//    }
        
    public function after(){
        $this->oLayout->show();
    }
	
	
}
