<table class="table table-striped">
	<tr>
		
		<th>rue</th>
		
		<th>ville</th>
		
		<th>pays</th>
		
		<th></th>
	</tr>
	<?php if($this->tAdresse):?>
		<?php foreach($this->tAdresse as $oAdresse):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oAdresse->rue ?></td>
		
		<td><?php echo $oAdresse->ville ?></td>
		
		<td><?php echo $oAdresse->pays ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('adresse::edit',array(
										'id'=>$oAdresse->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('adresse::delete',array(
										'id'=>$oAdresse->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('adresse::show',array(
										'id'=>$oAdresse->getId()
									) 
							)?>">Show</a>
			
				
				
			</td>
		</tr>	
		<?php endforeach;?>
	<?php else:?>
		<tr>
			<td colspan="4">Aucune ligne</td>
		</tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('adresse::new') ?>">New</a></p>
			
