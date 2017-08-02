<form class="form-horizontal" action="" method="POST">

	
	<div class="form-group">
		<label class="col-sm-2 control-label">rue</label>
		<div class="col-sm-10"><?php echo $this->oAdresse->rue ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">ville</label>
		<div class="col-sm-10"><?php echo $this->oAdresse->ville ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">pays</label>
		<div class="col-sm-10"><?php echo $this->oAdresse->pays ?></div>
	</div>
		



<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input class="btn btn-danger" type="submit" value="Confirmer la suppression" /> <a class="btn btn-link" href="<?php echo $this->getLink('adresse::list')?>">Annuler</a>
	</div>
</div>

</form>
