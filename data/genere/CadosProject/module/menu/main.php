<?php
Class module_menu extends abstract_moduleembedded{
		
	public function _index(){
		
		$UserConnect = _root::getAuth()->getAccount();
		if(isset($UserConnect)){
			$tLink=array(
			'Accueil' => 'default::index',
			'Déconnexion' => 'auth::logout',
			'À Propos' => 'purpose::info'
			);
		}else{
			$tLink=array(
			'Connexion' => 'auth::login',
			'Inscription' => 'auth::inscription',
			'Accueil' => 'default::index'
			);
		}
		
		
		$oView=new _view('menu::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}
