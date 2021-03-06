<?php 
class module_casier extends abstract_module{
	
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
		
		$tCasier=model_casier::getInstance()->findAll();
		
		$oView=new _view('casier::list');
		$oView->tCasier=$tCasier;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oCasier=new row_casier;
		
		$oView=new _view('casier::new');
		$oView->oCasier=$oCasier;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oCasier=model_casier::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('casier::edit');
		$oView->oCasier=$oCasier;
		$oView->tId=model_casier::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oCasier=model_casier::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('casier::show');
		$oView->oCasier=$oCasier;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oCasier=model_casier::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('casier::delete');
		$oView->oCasier=$oCasier;
		
		

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
			$oCasier=new row_casier;	
		}else{
			$oCasier=model_casier::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('numero','etat','id_utilisateur');
		foreach($tColumn as $sColumn){
			$oCasier->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oCasier->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('casier::list');
		}else{
			return $oCasier->getListError();
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
	
		$oCasier=model_casier::getInstance()->findById( _root::getParam('id',null) );
				
		$oCasier->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('casier::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

