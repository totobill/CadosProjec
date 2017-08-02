<table class="table table-striped">
	<tr>
		
		<th>id_utilisateur</th>
		
		<th>num_forfait</th>
		
		<th></th>
	</tr>
	<?php if($this->tForfait):?>
		<?php foreach($this->tForfait as $oForfait):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oForfait->id_utilisateur ?></td>
		
		<td><?php echo $oForfait->num_forfait ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('forfait::edit',array(
										'id'=>$oForfait->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('forfait::delete',array(
										'id'=>$oForfait->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('forfait::show',array(
										'id'=>$oForfait->getId()
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

<p><a class="btn btn-primary" href="<?php echo $this->getLink('forfait::new') ?>">New</a></p>
			
