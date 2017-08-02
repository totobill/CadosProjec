<?php 
$oForm=new plugin_form($this->oUtilisateur);
$oForm->setMessage($this->tMessage);
?>
<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">nom</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('nom',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">prenom</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('prenom',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">date_de_naissance</label>
		<div class="col-sm-10"><?php echo $oForm->getInputDate('date_de_naissance',array('class'=>'form-control')) ?></div>
	</div>
			
	<div class="form-group">
		<label class="col-sm-2 control-label">numero</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('numero',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">email</label>
		<div class="col-sm-10"><?php echo $oForm->getInputEmail('email',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">pseudo</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('pseudo',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">mot de passe</label>
		<div class="col-sm-10"><?php echo $oForm->getInputPassword('password',array('class'=>'form-control')) ?></div>
	</div>

	<div class="form-group">
		<label class="col-sm-2 control-label">Abonnement</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('Abonnement',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">id_bouton</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('id_bouton',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">connecte</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('connecte',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">type_user</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('type_user',array('class'=>'form-control')) ?></div>
	</div>
		
	
	

<?php echo $oForm->getToken('token',$this->token)?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-success" value="Modifier" /> <a class="btn btn-link" href="<?php echo $this->getLink('utilisateur::list')?>">Annuler</a>
	</div>
</div>
</form>

