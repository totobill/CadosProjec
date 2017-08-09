<?php 
class module_forfait extends abstract_module{
	
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
		
		$tForfait=model_forfait::getInstance()->findAll();
		
		$oView=new _view('forfait::list');
		$oView->tForfait=$tForfait;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oForfait=new row_forfait;
		
		$oView=new _view('forfait::new');
		$oView->oForfait=$oForfait;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oForfait=model_forfait::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('forfait::edit');
		$oView->oForfait=$oForfait;
		$oView->tId=model_forfait::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oForfait=model_forfait::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('forfait::show');
		$oView->oForfait=$oForfait;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oForfait=model_forfait::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('forfait::delete');
		$oView->oForfait=$oForfait;
		
		

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
			$oForfait=new row_forfait;	
		}else{
			$oForfait=model_forfait::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('id_utilisateur','num_forfait');
		foreach($tColumn as $sColumn){
			$oForfait->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oForfait->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('forfait::list');
		}else{
			return $oForfait->getListError();
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
	
		$oForfait=model_forfait::getInstance()->findById( _root::getParam('id',null) );
				
		$oForfait->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('forfait::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

