<?php
class model_casier extends abstract_model{
	
	protected $sClassRow='row_casier';
	
	protected $sTable='casier';
	protected $sConfig='pdoMysqlExple';
	
	protected $tId=array('id_bouton');

	public static function getInstance(){
		return self::_getInstance(__CLASS__);
	}

	public function findById($uId){
		return $this->findOne('SELECT * FROM '.$this->sTable.' WHERE id_bouton=?',$uId );
	}
	public function findAll(){
		return $this->findMany('SELECT * FROM '.$this->sTable);
	}

        public function setEtat0($iIdCasier){
            $this->execute('UPDATE casier SET etat = 0, id_utilisateur =0 WHERE id_bouton =?',$iIdCasier);
            
        }
	
        public function setEtat1($iIdCasier,$iIdUtilisateur){
            $this->execute('UPDATE casier SET etat = 1,  id_utilisateur =? WHERE id_bouton =?',$iIdUtilisateur,$iIdCasier);
        }
	
	
	public function getSelect(){
		$tab=$this->findAll();
		$tSelect=array();
		if($tab){
		foreach($tab as $oRow){
			$tSelect[ $oRow->id_bouton ]=$oRow->numero;
		}
		}
		return $tSelect;
	}
			
	

}

class row_casier extends abstract_row{
	
	protected $sClassModel='model_casier';
	
	/*exemple jointure 
	public function findAuteur(){
		return model_auteur::getInstance()->findById($this->auteur_id);
	}
	*/
	/*exemple test validation*/
	private function getCheck(){
		$oPluginValid=new plugin_valid($this->getTab());
		
		
		/* renseigner vos check ici
		$oPluginValid->isEqual('champ','valeurB','Le champ n\est pas égal à '.$valeurB);
		$oPluginValid->isNotEqual('champ','valeurB','Le champ est égal à '.$valeurB);
		$oPluginValid->isUpperThan('champ','valeurB','Le champ n\est pas supé à '.$valeurB);
		$oPluginValid->isUpperOrEqualThan('champ','valeurB','Le champ n\est pas supé ou égal à '.$valeurB);
		$oPluginValid->isLowerThan('champ','valeurB','Le champ n\est pas inférieur à '.$valeurB);
		$oPluginValid->isLowerOrEqualThan('champ','valeurB','Le champ n\est pas inférieur ou égal à '.$valeurB);
		$oPluginValid->isEmpty('champ','Le champ n\'est pas vide');
		$oPluginValid->isNotEmpty('champ','Le champ ne doit pas être vide');
		$oPluginValid->isEmailValid('champ','L\email est invalide');
		$oPluginValid->matchExpression('champ','/[0-9]/','Le champ n\'est pas au bon format');
		$oPluginValid->notMatchExpression('champ','/[a-zA-Z]/','Le champ ne doit pas être a ce format');
		*/

		return $oPluginValid;
	}

	public function isValid(){
		return $this->getCheck()->isValid();
	}
	public function getListError(){
		return $this->getCheck()->getListError();
	}
	public function save(){
		if(!$this->isValid()){
			return false;
		}
		parent::save();
		return true;
	}

}
