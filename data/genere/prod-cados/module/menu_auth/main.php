<?php
Class module_menu_auth extends abstract_moduleembedded{
		
	public function _index(){
		
		$tLink=array(
			'Se connect&eacute;' => 'auth::login',
'Inscription' => 'auth::inscription',

		);
		
		$oView=new _view('menu_auth::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}
