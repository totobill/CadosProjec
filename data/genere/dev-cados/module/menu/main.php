<?php
Class module_menu extends abstract_moduleembedded{
		
	public function _index(){
		
            $tLink=array(
                'Accueil' => 'default::index',
                'Droits' => 'rightsManagerMulti::index',
                'Administrer utilisateurs' => 'utilisateur::list',
                'Profil' => 'configuration::profil',
                'À Propos' => 'purpose::info',
                'Se déconnecter' => 'auth::logout'
            );
		
                foreach ($tLink as $sLabel => $sLink){
                    //si l'utilisateur n'a pas le droit d'acceder au lein
                    if(!_root::getACL()->can('access',$sLink)){
                        //on supprime le lien du menu
                        unset($tLink[$sLabel]);
                    }
                }
                
		$oView=new _view('menu::index');
		$oView->tLink=$tLink;
		
		return $oView;
	}
}
