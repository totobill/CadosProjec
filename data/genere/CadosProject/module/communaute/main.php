<?php 
class module_communaute extends abstract_module{
	
	public function before(){
                $this->oLayout=new _layout('bootstrap');
				$this->oLayout->addModule('menu','menu::index');
                
	}
	
	public function _index(){
		$oAllUser = model_utilisateur::getInstance()->findAll();
		$oView=new _view('communaute::index');
		$this->oLayout->add('main',$oView);
		$oView->oAllUser=$oAllUser;
	}
	
	
     
     
    public function after(){
		$this->oLayout->show();
	}
	
	
}

?>    
