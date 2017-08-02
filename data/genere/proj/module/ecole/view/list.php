<table class="table table-striped">
	<tr>
		
		<th>nom</th>
		
		<th>id_adresse</th>
		
		<th></th>
	</tr>
	<?php if($this->tEcole):?>
		<?php foreach($this->tEcole as $oEcole):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oEcole->nom ?></td>
		
		<td><?php echo $oEcole->id_adresse ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('ecole::edit',array(
										'id'=>$oEcole->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('ecole::delete',array(
										'id'=>$oEcole->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('ecole::show',array(
										'id'=>$oEcole->getId()
									) 
							)?>">Show</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="3">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('ecole::new') ?>">New</a></p>
			
