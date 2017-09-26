<?php 
$oForm=new plugin_form($this->oUtilisateur);
$oForm->setMessage($this->tMessage);
?>

<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Nom</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('nom',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Prénom</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('prenom',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Date de naissance</label>
		<div class="col-sm-10"><?php echo $oForm->getInputDate('date_de_naissance',array('class'=>'form-control')) ?></div>
	</div>
			
	<div class="form-group">
		<label class="col-sm-2 control-label">Numéro</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('numero',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10"><?php echo $oForm->getInputEmail('email',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Pseudo</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('pseudo',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Mot de passe</label>
		<div class="col-sm-10"><?php echo $oForm->getInputPassword('password',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Casier réservé (0 = Aucun)</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('id_bouton',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">connecté ? (0 non connecté, 1 connecté)</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('connecte',array('class'=>'form-control')) ?></div>
	</div>
	
	

<?php echo $oForm->getToken('token',$this->token)?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-success" value="Modifier" /><a class="btn btn-link" href="<?php echo $this->getLink('utilisateur::list')?>">Annuler</a>
	</div>
</div>
</form>

