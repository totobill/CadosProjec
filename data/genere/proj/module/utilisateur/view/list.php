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
		
		<th>connect&Atilde;&copy;</th>
		
		<th></th>
	</tr>
	<?php if($this->tUtilisateur):?>
		<?php foreach($this->tUtilisateur as $oUtilisateur):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
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
		
		<td><?php echo $oUtilisateur->connecté ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('utilisateur::edit',array(
										'id'=>$oUtilisateur->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('utilisateur::delete',array(
										'id'=>$oUtilisateur->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::show',array(
										'id'=>$oUtilisateur->getId()
									) 
							)?>">Show</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="12">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('utilisateur::new') ?>">New</a></p>
			
