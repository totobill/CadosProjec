<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">nom</label>
		<div class="col-sm-10"><?php echo $this->oEcole->nom ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">id_adresse</label>
		<div class="col-sm-10"><?php echo $this->oEcole->id_adresse ?></div>
	</div>
		
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('ecole::list')?>">Retour</a>
		</div>
	</div>
</form>
