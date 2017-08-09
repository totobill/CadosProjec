<?php
class model_rightsManagerMulti extends abstract_model{
	
	protected $sClassRow='row_rightsManagerMulti';
	
	protected $sTable='Permissions';
	protected $sConfig='pdoMysqlExple';
	
	protected $tId=array('id');

	public static function getInstance(){
		return self::_getInstance(__CLASS__);
	}

	public function findById($uId){
		return $this->findOne('SELECT * FROM '.$this->sTable.' WHERE id=?',$uId );
	}
	public function findAll(){
		return $this->findMany('
		SELECT 
			Actions.name as actionName, 
			Items.name as itemName,
			Groups.name as groupName,
			Permissions.id 

		FROM Permissions
			INNER JOIN Actions
				ON Actions.id=Permissions.actions_id
			INNER JOIN Items
				ON Items.id=Permissions.items_id
			INNER JOIN Groups
				ON Groups.id=Permissions.groups_id
		
			');
	}
	
	public function findListByUser($user_id){
		return $this->findManySimple('
		SELECT 
			Actions.name as actionName, 
			Items.name as itemName
		FROM Permissions
			INNER JOIN GroupsUsers
				ON GroupsUsers.groups_id=Permissions.groups_id
			INNER JOIN Actions
				ON Actions.id=Permissions.actions_id
			INNER JOIN Items
				ON Items.id=Permissions.items_id
		WHERE GroupsUsers.users_id=?
			',$user_id);
	}
	
	public function insertGroup($sName){
		$this->execute('INSERT INTO Groups (name) VALUES(?)',$sName);
	}
	public function insertAction($sName){
		$this->execute('INSERT INTO Actions (name) VALUES(?)',$sName);
	}
	public function insertItem($sName){
		$this->execute('INSERT INTO Items (name) VALUES(?)',$sName);
	}
	
	public function findGroupByName($sName){
		return $this->findOneSimple('SELECT id as id FROM Groups WHERE name=?',$sName);
	}
	public function findActionByName($sName){
		return $this->findOneSimple('SELECT id as id FROM Actions WHERE name=?',$sName);
	}
	public function findItemByName($sName){
		return $this->findOneSimple('SELECT id as id FROM Items WHERE name=?',$sName);
	}
	
	public function findSelectGroup(){
		$tItem=$this->findManySimple('SELECT id,name FROM Groups');
		$tSelect=array();
		if($tItem){
			foreach($tItem as $oItem){
				$tSelect[ $oItem->id ]=$oItem->name;
			}
		}
		return $tSelect;
	}
	public function findSelectAction(){
		$tItem=$this->findManySimple('SELECT id,name FROM Actions');
		$tSelect=array();
		if($tItem){
			foreach($tItem as $oItem){
				$tSelect[ $oItem->id ]=$oItem->name;
			}
		}
		return $tSelect;
	}
	public function findSelectItem(){
		$tItem=$this->findManySimple('SELECT id,name FROM Items');
		$tSelect=array();
		if($tItem){
			foreach($tItem as $oItem){
				$tSelect[ $oItem->id ]=$oItem->name;
			}
		}
		return $tSelect;
	}
	
	public function findListUser(){
		return $this->findManySimple('SELECT id_utilisateur,email  FROM utilisateur');
	}
	public function findUserById($user_id){
		return $this->findOneSimple('SELECT id_utilisateur,email FROM utilisateur WHERE id_utilisateur=?',$user_id);
	}
	public function findListGroupByUser($user_id){
		$tRow=$this->findManySimple('SELECT groups_id FROM GroupsUsers WHERE users_id=?',$user_id);
		$tGroup=array();
		foreach($tRow as $oRow){
			$tGroup[$oRow->groups_id]=$oRow->groups_id;
		}
		return $tGroup;
	}
	public function updateUserGroup($user_id,$tGroup){
		$this->execute('DELETE FROM GroupsUsers WHERE users_id=?',array($user_id));
		if($tGroup){
			foreach($tGroup as $group_id){
				$this->execute('INSERT INTO GroupsUsers (groups_id,users_id) VALUES (?,?)',array($group_id,$user_id));
			}
		}
	}
	
	public function loadForUser($oUser){
		//on purge
		_root::getACL()->purge();
		
		$tPermission=$this->findListByUser($oUser->id_utilisateur);
		if($tPermission){
			foreach($tPermission as $oPermission){
				_root::getACL()->allow($oPermission->actionName,$oPermission->itemName);
			}
		}
	}
	
}
class row_rightsManagerMulti extends abstract_row{
	
	protected $sClassModel='model_rightsManagerMulti';
	
	/*exemple jointure 
	public function findAuteur(){
		return model_auteur::getInstance()->findById($this->auteur_id);
	}
	*/
	/*exemple test validation*/
	private function getCheck(){
		$oPluginValid=new plugin_valid($this->getTab());
		/* renseigner vos check ici
		$oPluginValid->isEqual('champ','valeurB','Le champ n\est pas &eacute;gal &agrave; '.$valeurB);
		$oPluginValid->isNotEqual('champ','valeurB','Le champ est &eacute;gal &agrave; '.$valeurB);
		$oPluginValid->isUpperThan('champ','valeurB','Le champ n\est pas sup&eacute; &agrave; '.$valeurB);
		$oPluginValid->isUpperOrEqualThan('champ','valeurB','Le champ n\est pas sup&eacute; ou &eacute;gal &agrave; '.$valeurB);
		$oPluginValid->isLowerThan('champ','valeurB','Le champ n\est pas inf&eacute;rieur &agrave; '.$valeurB);
		$oPluginValid->isLowerOrEqualThan('champ','valeurB','Le champ n\est pas inf&eacute;rieur ou &eacute;gal &agrave; '.$valeurB);
		$oPluginValid->isEmpty('champ','Le champ n\'est pas vide');
		$oPluginValid->isNotEmpty('champ','Le champ ne doit pas &ecirc;tre vide');
		$oPluginValid->isEmailValid('champ','L\email est invalide');
		$oPluginValid->matchExpression('champ','/[0-9]/','Le champ n\'est pas au bon format');
		$oPluginValid->notMatchExpression('champ','/[a-zA-Z]/','Le champ ne doit pas &ecirc;tre a ce format');
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
