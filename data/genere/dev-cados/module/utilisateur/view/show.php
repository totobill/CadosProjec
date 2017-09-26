<form class="form-horizontal" action="" method="POST" >
	
	<div class="form-group">
		<label class="col-sm-2 control-label">Nom</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->nom ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Prénom</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->prenom ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Date de naissance</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->date_de_naissance ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Numero</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->numero ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->email ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Pseudo</label>
		<div class="col-sm-10"><?php echo $this->oUtilisateur->pseudo ?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">Casier réservé</label>
                <div class="col-sm-10"><?php switch ($this->oUtilisateur->id_bouton){
                    case 0:
                        echo "Aucun";
                        break;
                    default:
                        echo $this->oUtilisateur->id_bouton;
                }?></div>
	</div>
		
	<div class="form-group">
		<label class="col-sm-2 control-label">En ligne ?</label>
                <div class="col-sm-10"><?php switch ($this->oUtilisateur->connecte){
                    case 0:
                        echo "Hors Ligne";
                        break;
                    case 1:
                        echo "En ligne";
                        break;
                }?></div>
	</div>
	
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::list')?>">Retour</a>
		</div>
	</div>
</form>
