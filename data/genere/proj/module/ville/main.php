<?php 
class module_ville extends abstract_module{
	
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
		
		$tVille=model_ville::getInstance()->findAll();
		
		$oView=new _view('ville::list');
		$oView->tVille=$tVille;
		
		
		
		$this->oLayout->add('main',$oView);
		 
	}
		
	
	
	public function _new(){
		$tMessage=$this->processSave();
	
		$oVille=new row_ville;
		
		$oView=new _view('ville::new');
		$oView->oVille=$oVille;
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
			
	
	
	public function _edit(){
		$tMessage=$this->processSave();
		
		$oVille=model_ville::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ville::edit');
		$oView->oVille=$oVille;
		$oView->tId=model_ville::getInstance()->getIdTab();
		
		
		
		$oPluginXsrf=new plugin_xsrf();
		$oView->token=$oPluginXsrf->getToken();
		$oView->tMessage=$tMessage;
		
		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _show(){
		$oVille=model_ville::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ville::show');
		$oView->oVille=$oVille;
		
		

		$this->oLayout->add('main',$oView);
	}
		
	
	
	public function _delete(){
		$tMessage=$this->processDelete();

		$oVille=model_ville::getInstance()->findById( _root::getParam('id') );
		
		$oView=new _view('ville::delete');
		$oView->oVille=$oVille;
		
		

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
			$oVille=new row_ville;	
		}else{
			$oVille=model_ville::getInstance()->findById( _root::getParam('id',null) );
		}
		
		$tColumn=array('nom','code_postal');
		foreach($tColumn as $sColumn){
			$oVille->$sColumn=_root::getParam($sColumn,null) ;
		}
		
		
		if($oVille->save()){
			//une fois enregistre on redirige (vers la page liste)
			_root::redirect('ville::list');
		}else{
			return $oVille->getListError();
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
	
		$oVille=model_ville::getInstance()->findById( _root::getParam('id',null) );
				
		$oVille->delete();
		//une fois enregistre on redirige (vers la page liste)
		_root::redirect('ville::list');
		
	}
		
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}

