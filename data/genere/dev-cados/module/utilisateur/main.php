<?php 
class module_utilisateur extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('bootstrap');
		$this->oLayout->addModule('menu', 'menu::index');
		//$this->oLayout->addModule('menu','menu::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tUtilisateur=model_utilisateur::getInstance()->findAll();
		
		$oView=new _view('utilisateur::list');
		$oView->tUtilisateur=$tUtilisateur;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oUtilisateur=new row_utilisateur;
		
		$oView=new _view('utilisateur::new');
		$oView->oUtilisateur=$oUtilisateur;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
		if(!$oUtilisateur){
                     $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                     $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
                }
		$oView=new _view('utilisateur::edit');
		$oView->oUtilisateur=$oUtilisateur;
		$oView->tId=model_utilisateur::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
		if(!$oUtilisateur){
                     $iId = (int)_root::getAuth()->getAccount()->id_utilisateur;
                     $oUtilisateur=model_utilisateur::getInstance()->findById($iId);
                }
		$oView=new _view('utilisateur::show');
		$oView->oUtilisateur=$oUtilisateur;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('utilisateur::delete');
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
		
		$tColumn=array('nom','prenom','date_de_naissance','numero','email','pseudo','id_bouton','connecte');
		foreach($tColumn as $sColumn){
			$oUtilisateur->$sColumn=_root::getParam($sColumn,null) ;
		}
		$sPassword=_root::getParam('password',null);
                $oUtilisateur->password=model_utilisateur::getInstance()->hashPassword($sPassword);
		
		if($oUtilisateur->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('utilisateur::list'); 
		}else{
			return $oUtilisateur->getListError();
		}
		
	}
	
	
	public function processDelete(){
		if(!_root::getRequest()->isPost() ){ //si ce n'est pas une requete POST on ne soumet pas
			return null;
		}
		
		$oPluginXsrf=new plugin_xsrf();
		if(!$oPluginXsrf->checkToken( _root::getParam('token') ) ){ //on verifie que le token est valide
			return array('token'=>$oPluginXsrf->getMessage() );
		}
	
		$oUtilisateur=model_utilisateur::getInstance()->findById( _root::getParam('id',null) );
				
		$oUtilisateur->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('utilisateur::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

