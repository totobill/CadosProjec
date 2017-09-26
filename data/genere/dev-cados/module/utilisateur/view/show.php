<form class="form-horizontal" action="" method="POST" >
    <table>
        
		<tr>
                    <td><label class="col-sm-2 control-label">Nom</label></td>
                    <td><div class="col-sm-10"><?php echo $this->oUtilisateur->nom ?></div></td>
                </tr>	


            <tr>
                    <td><label class="col-sm-2 control-label">Prénom</label></td>
                    <td><div class="col-sm-10"><?php echo $this->oUtilisateur->prenom ?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">Date de naissance</label></td>
		<td><div class="col-sm-10"><?php echo $this->oUtilisateur->date_de_naissance ?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">Numero</label></td>
		<td><div class="col-sm-10"><?php echo $this->oUtilisateur->numero ?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">Email</label></td>
		<td><div class="col-sm-10"><?php echo $this->oUtilisateur->email ?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">Pseudo</label></td>
		<td><div class="col-sm-10"><?php echo $this->oUtilisateur->pseudo ?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">Casier réservé</label></td>
                <td><div class="col-sm-10"><?php switch ($this->oUtilisateur->id_bouton){
                    case 0:
                        echo "Aucun";
                        break;
                    default:
                        echo $this->oUtilisateur->id_bouton;
                }?></div></td>
            </tr>

		

            <tr>
		<td><label class="col-sm-2 control-label">En ligne ?</label></td>
                <td><div class="col-sm-10"><?php switch ($this->oUtilisateur->connecte){
                    case 0:
                        echo "Hors Ligne";
                        break;
                    case 1:
                        echo "En ligne";
                        break;
                }?></div></td>
            </tr>

        </table>
	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
			 <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::list')?>">Retour</a>
		</div>
	</div>
    
</form>
