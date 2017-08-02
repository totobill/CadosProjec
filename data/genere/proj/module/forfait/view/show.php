<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">id_utilisateur</label>
		<div class="col-sm-10"><?php echo $this->oForfait->id_utilisateur ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">num_forfait</label>
		<div class="col-sm-10"><?php echo $this->oForfait->num_forfait ?></div>
	</div>
		
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('forfait::list')?>">Retour</a>
		</div>
	</div>
</form>
