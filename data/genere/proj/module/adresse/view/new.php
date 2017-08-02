<?php 
$oForm=new plugin_form($this->oAdresse);
$oForm->setMessage($this->tMessage);
?>
<form class="form-horizontal" action="" method="POST" >

	
	<div class="form-group">
		<label class="col-sm-2 control-label">rue</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('rue',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">ville</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('ville',array('class'=>'form-control')) ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">pays</label>
		<div class="col-sm-10"><?php echo $oForm->getInputText('pays',array('class'=>'form-control')) ?></div>
	</div>
		
	

<?php echo $oForm->getToken('token',$this->token)?>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input type="submit" class="btn btn-success" value="Ajouter" /> <a class="btn btn-link" href="<?php echo $this->getLink('adresse::list')?>">Annuler</a>
	</div>
</div>
</form>
