<form class="form-horizontal" action="" method="POST" >
    <table class="table">
        
		<tr>
                    <td><label class="control-label">Nom</label></td>
                    <td><?php echo $this->oUtilisateur->nom ?></td>
                </tr>	


            <tr>
                    <td><label class="control-label">Prénom</label></td>
                    <td><?php echo $this->oUtilisateur->prenom ?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">Date de naissance</label></td>
		<td><?php echo $this->oUtilisateur->date_de_naissance ?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">Numero</label></td>
		<td><?php echo $this->oUtilisateur->numero ?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">Email</label></td>
		<td><?php echo $this->oUtilisateur->email ?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">Pseudo</label></td>
		<td><?php echo $this->oUtilisateur->pseudo ?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">Casier réservé</label></td>
                <td><?php switch ($this->oUtilisateur->id_bouton){
                    case 0:
                        echo "Aucun";
                        break;
                    default:
                        echo $this->oUtilisateur->id_bouton;
                }?></td>
            </tr>

		

            <tr>
		<td><label class="control-label">En ligne ?</label></td>
                <td><?php switch ($this->oUtilisateur->connecte){
                    case 0:
                        echo "Hors Ligne";
                        break;
                    case 1:
                        echo "En ligne";
                        break;
                }?></td>
            </tr>

        </table>
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::list')?>">Retour</a>
		</div>
	</div>
    
</form>
