<?php
Class module_menu extends abstract_moduleembedded{
		
	public function _index(){
		
		$tLink=array(
			'Acceuil' => 'default::index',

		);
		
		$oView=new _view('menu::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}
