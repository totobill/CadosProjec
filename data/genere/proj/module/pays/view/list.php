<table class="table table-striped">
	<tr>
		
		<th>nom</th>
		
		<th></th>
	</tr>
	<?php if($this->tPays):?>
		<?php foreach($this->tPays as $oPays):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oPays->nom ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('pays::edit',array(
										'id'=>$oPays->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('pays::delete',array(
										'id'=>$oPays->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('pays::show',array(
										'id'=>$oPays->getId()
									) 
							)?>">Show</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="2">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('pays::new') ?>">New</a></p>
			
