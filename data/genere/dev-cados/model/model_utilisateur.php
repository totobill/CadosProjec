<?php
class model_utilisateur extends abstract_model{
	
	protected $sClassRow='row_utilisateur';
	
	protected $sTable='utilisateur';
	protected $sConfig='pdoMysqlExple';
	
	protected $tId=array('id_utilisateur');

	public static function getInstance(){
		return self::_getInstance(__CLASS__);
	}

	public function findById($uId){
            return $this->findOne('SELECT * FROM '.$this->sTable.' WHERE id_utilisateur=?',$uId );
	}
	public function findAll(){
            return $this->findMany('SELECT * FROM '.$this->sTable); 
	}
	

        public function findByEmail($sEmail){
            return $this->findOne('SELECT * FROM '.$this->sTable.' WHERE email=?', $sEmail);
        }
        
        public function setIdBouton($iIdBouton,$iIdUtilisateur){
            $this->execute('UPDATE utilisateur SET id_bouton =? WHERE id_utilisateur =?',$iIdBouton,$iIdUtilisateur);
        }
        
        public function setIdBouton0($iIdUtilisateur){
            $this->execute('UPDATE utilisateur SET id_bouton =0 WHERE id_utilisateur =?',$iIdUtilisateur);
        }
        
        public function setConnecte0($iIdUtilisateur){
            $this->execute('UPDATE utilisateur SET connecte =0 WHERE id_utilisateur =?',$iIdUtilisateur);
        }
		
        public function setConnecte1($iIdUtilisateur){
            $this->execute('UPDATE utilisateur SET connecte =1 WHERE id_utilisateur =?',$iIdUtilisateur);
        }

	public function getConfirmation($iIdUtilisateur){
		return $this->findOne('SELECT cle, actif FROM ' .$this->sTable. ' WHERE id_utilisateur=?', $iIdUtilisateur);
	}

	public function setCle($sLogin, $cle){
		$this->execute('UPDATE ' .$this->sTable. ' SET cle=? WHERE email=?',$cle,$sLogin);
	}
	
	public function setActif($iIdUtilisateur){
		$this->execute('UPDATE ' .$this->sTable. ' SET actif=1 WHERE id_utilisateur=?', $iIdUtilisateur);
	}

	public function getIdUtilisateur($email){
		return $this->findOne('SELECT id_utilisateur FROM ' .$this->sTable. ' WHERE email=?', $email);
	}
	
        public function getId_Bouton($iIdUtilisateur){
            return (int)$this->findOne('SELECT id_bouton FROM utilisateur WHERE id_utilisateur =?',$iIdUtilisateur)->id_bouton;
        }

	public function getSelect(){
		$tab=$this->findAll();
		$tSelect=array();
		if($tab){
		foreach($tab as $oRow){
			$tSelect[ $oRow->id_utilisateur ]=$oRow->nom;
		}
		}
		return $tSelect;
	}
        
        public function getListAccount(){
  
            $tAccount=$this->findAll();

            $tLoginPassAccount=array();

            if($tAccount){
                foreach($tAccount as $oAccount){
                    //on cree ici un tableau indexe par nom d'utilisateur et mot de pase
                    $tLoginPassAccount[$oAccount->email][$oAccount->password]=$oAccount;
                }
            }

            return $tLoginPassAccount;

        }
        
        public function getListEmail(){
            
            $tAccount=$this->findAll();

            $tLoginPassAccount=array();

            if($tAccount){
                foreach($tAccount as $oAccount){
                    //on cree ici un tableau indexe par email d'utilisateur
                    $tLoginPassAccount[$oAccount->email]=$oAccount;
                }
            }

            return $tLoginPassAccount;
        }
        
        public function hashPassword($sPassword){
            //utiliser ici la methode de votre choix pour hasher votre mot de passe
            return sha1('bonja2AdnERk'.$sPassword);
        }
			
	

}

class row_utilisateur extends abstract_row{
	
	protected $sClassModel='model_utilisateur';
	
	/*exemple jointure 
	public function findAuteur(){
		return model_auteur::getInstance()->findById($this->auteur_id);
	}
	*/
        
        private function getCheckModification(){
            $oPluginValid=new plugin_valid($this->getTab());
            $oPluginValid->isEmailValid('email','L\'email est invalide');
            $oPluginValid->isNotEmpty('email','Le champ ne doit pas être vide');
//            $oPluginValid->isNotEmpty('password','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('nom','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('prenom','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('date_de_naissance','Le champ ne doit pas être vide');
            $oPluginValid->matchExpression('date_de_naissance','/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/','Le champ n\'est pas au bon format (AAAA-MM-JJ)');
            if(strlen($this->getTab()["numero"]) > 0){
                $oPluginValid->matchExpression('numero','/[0-9]{10}/','Le champ n\'est pas au bon format');
            }
//            $oPluginValid->isNotEmpty('numero','Le champ ne doit pas être vide');
            
            return $oPluginValid;
        }
        
	/*exemple test validation*/
	private function getCheck(){
            $oPluginValid=new plugin_valid($this->getTab());
            $oPluginValid->isEmailValid('email','L\'email est invalide');
            $oPluginValid->isNotEmpty('email','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('password','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('nom','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('prenom','Le champ ne doit pas être vide');
            $oPluginValid->isNotEmpty('date_de_naissance','Le champ ne doit pas être vide');
            $oPluginValid->matchExpression('date_de_naissance','/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/','Le champ n\'est pas au bon format (AAAA-MM-JJ)');
                
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

        public function isValidModification(){
		return $this->getCheckModification()->isValid();
	}
        
        public function getListErrorModification(){
		return $this->getCheckModification()->getListError();
	}
        
        public function saveModification(){
            if(!$this->isValidModification()){  
                return false;
            }
            parent::save();
            return true;
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
