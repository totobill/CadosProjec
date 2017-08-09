<form class="form-horizontal" action="" method="POST" >
	
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
		
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('adresse::list')?>">Retour</a>
		</div>
	</div>
</form>
