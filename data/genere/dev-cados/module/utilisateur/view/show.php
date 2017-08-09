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
		<label class="col-sm-2 control-label">adresse</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->adresse ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">numero</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->numero ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">email</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->email ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">pseudo</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->pseudo ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">password</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->password ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Abonnement</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->Abonnement ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">id_bouton</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->id_bouton ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">connecte</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->connecte ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">type_user</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->type_user ?></div>
	</div>
		
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::list')?>">Retour</a>
		</div>
	</div>
</form>
