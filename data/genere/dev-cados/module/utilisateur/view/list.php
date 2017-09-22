<table class="table table-striped">
	<tr>
		
		<th>nom</th>
		
		<th>prenom</th>
		
		<th>date_de_naissance</th>
		
		<th>adresse</th>
		
		<th>numero</th>
		
		<th>email</th>
		
		<th>pseudo</th>
		
		<th>password</th>
		
		<th>Abonnement</th>
		
		<th>id_bouton</th>
		
		<th>connecte</th>
		
		<th>type_user</th>
		
		<th></th>
	</tr>
	<?php if($this->tUtilisateur):?>
		<?php foreach($this->tUtilisateur as $oUtilisateur):?>
		<?php switch ($oUtilisateur->nbr_jour_reservation){
                    case 0:
                        $color = '#36F253';
                        $font = '#000000';
                        break;
                    case 1:
                        $color = '#FEF201';
                        $font = '#000000';
                        break;
                    case 2:
                        $color = '#FE7C01';
                        $font = '#000000';
                        break;
                    case 3:
                        $color = '#FE0601';
                        $font = '#000000';
                        break;
                        
                    default:
                        $color = '#000000';
                        $font = '#FEFEFE';
                        break;
                }
                ?>
        <tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?> BGCOLOR="<?php echo $color; ?>" style="color:<?php echo $font;?>">
			
		<td><?php echo $oUtilisateur->nom ?></td>
		
		<td><?php echo $oUtilisateur->prenom ?></td>
		
		<td><?php echo $oUtilisateur->date_de_naissance ?></td>
		
		<td><?php echo $oUtilisateur->adresse ?></td>
		
		<td><?php echo $oUtilisateur->numero ?></td>
		
		<td><?php echo $oUtilisateur->email ?></td>
		
		<td><?php echo $oUtilisateur->pseudo ?></td>
		
		<td><?php echo $oUtilisateur->password ?></td>
		
		<td><?php echo $oUtilisateur->Abonnement ?></td>
		
		<td><?php echo $oUtilisateur->id_bouton ?></td>
		
		<td><?php echo $oUtilisateur->connecte ?></td>
		
		<td><?php echo $oUtilisateur->type_user ?></td>

                <td><?php echo $oUtilisateur->nbr_jour_reservation ?></td>
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('utilisateur::edit',array('id'=>$oUtilisateur->getId()))?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('utilisateur::delete',array('id'=>$oUtilisateur->getId()) )?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::show',array('id'=>$oUtilisateur->getId()) )?>">Show</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="13">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('utilisateur::new') ?>">New</a></p>
			
