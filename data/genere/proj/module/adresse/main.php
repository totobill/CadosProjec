<?php 
class module_adresse extends abstract_module{
	
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
		
		$tAdresse=model_adresse::getInstance()->findAll();
		
		$oView=new _view('adresse::list');
		$oView->tAdresse=$tAdresse;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oAdresse=new row_adresse;
		
		$oView=new _view('adresse::new');
		$oView->oAdresse=$oAdresse;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oAdresse=model_adresse::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('adresse::edit');
		$oView->oAdresse=$oAdresse;
		$oView->tId=model_adresse::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oAdresse=model_adresse::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('adresse::show');
		$oView->oAdresse=$oAdresse;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oAdresse=model_adresse::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('adresse::delete');
		$oView->oAdresse=$oAdresse;
		
		

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
			$oAdresse=new row_adresse;	
		}else{
			$oAdresse=model_adresse::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('rue','ville','pays');
		foreach($tColumn as $sColumn){
			$oAdresse->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oAdresse->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('adresse::list');
		}else{
			return $oAdresse->getListError();
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
	
		$oAdresse=model_adresse::getInstance()->findById( _root::getParam('id',null) );
				
		$oAdresse->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('adresse::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

