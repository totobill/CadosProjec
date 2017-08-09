<?php 
class module_ecole extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('bootstrap');
		
		//$this->oLayout->addModule('menu','menu::index');
$this->oLayout->addModule('menu','menu::index');
	}
	
	
	public function _index(){
	    //on considere que la page par defaut est la page de listage
	    $this->_list();
	}
	
	
	public function _list(){
		
		$tEcole=model_ecole::getInstance()->findAll();
		
		$oView=new _view('ecole::list');
		$oView->tEcole=$tEcole;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oEcole=new row_ecole;
		
		$oView=new _view('ecole::new');
		$oView->oEcole=$oEcole;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oEcole=model_ecole::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ecole::edit');
		$oView->oEcole=$oEcole;
		$oView->tId=model_ecole::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oEcole=model_ecole::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ecole::show');
		$oView->oEcole=$oEcole;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oEcole=model_ecole::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ecole::delete');
		$oView->oEcole=$oEcole;
		
		

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
			$oEcole=new row_ecole;	
		}else{
			$oEcole=model_ecole::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('nom','id_adresse');
		foreach($tColumn as $sColumn){
			$oEcole->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oEcole->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('ecole::list');
		}else{
			return $oEcole->getListError();
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
	
		$oEcole=model_ecole::getInstance()->findById( _root::getParam('id',null) );
				
		$oEcole->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('ecole::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

