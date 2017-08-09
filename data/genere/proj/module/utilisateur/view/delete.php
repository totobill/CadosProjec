<form class="form-horizontal" action="" method="POST">

	
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
		<label class="col-sm-2 control-label">connect&Atilde;&copy;</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->connecté ?></div>
	</div>
		



<input type="hidden" name="token" value="<?php echo $this->token?>" />
<?php if($this->tMessage and isset($this->tMessage['token'])): echo $this->tMessage['token']; endif;?>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
		<input class="btn btn-danger" type="submit" value="Confirmer la suppression" /> <a class="btn btn-link" href="<?php echo $this->getLink('utilisateur::list')?>">Annuler</a>
	</div>
</div>

</form>
