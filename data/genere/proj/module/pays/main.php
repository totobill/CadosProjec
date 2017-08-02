<?php 
class module_pays extends abstract_module{
	
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
		
		$tPays=model_pays::getInstance()->findAll();
		
		$oView=new _view('pays::list');
		$oView->tPays=$tPays;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oPays=new row_pays;
		
		$oView=new _view('pays::new');
		$oView->oPays=$oPays;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oPays=model_pays::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('pays::edit');
		$oView->oPays=$oPays;
		$oView->tId=model_pays::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oPays=model_pays::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('pays::show');
		$oView->oPays=$oPays;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oPays=model_pays::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('pays::delete');
		$oView->oPays=$oPays;
		
		

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
			$oPays=new row_pays;	
		}else{
			$oPays=model_pays::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('nom');
		foreach($tColumn as $sColumn){
			$oPays->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oPays->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('pays::list');
		}else{
			return $oPays->getListError();
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
	
		$oPays=model_pays::getInstance()->findById( _root::getParam('id',null) );
				
		$oPays->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('pays::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

