<?php 
class module_configuration extends abstract_module{
	
	public function before(){
		$this->oLayout=new _layout('bootstrap');
		
		$this->oLayout->addModule('menu','menu::index');
	}
	
	
	public function _profil(){
	
		$oView=new _view('configuration::profil');
		
		$this->oLayout->add('main',$oView);
                
                $iIdUtilisateur = (int)_root::getAuth()->getAccount()->id_utilisateur;
                $oUtilisateur = model_utilisateur::getInstance()->findById($iIdUtilisateur);
		$oView->tInfo=$oUtilisateur;
	}
        
			
	
	public function after(){
		$this->oLayout->show();
	}
	
	
}
