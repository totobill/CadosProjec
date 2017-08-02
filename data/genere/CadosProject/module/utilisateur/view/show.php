<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">nom</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->nom ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">prenom</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->prenom ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">date_de_naissance</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->date_de_naissance ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">email</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->email ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">password</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->password ?></div>
	</div>
		
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::list')?>">Retour</a>
		</div>
	</div>
</form>
