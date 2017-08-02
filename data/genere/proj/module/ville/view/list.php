<table class="table table-striped">
	<tr>
		
		<th>nom</th>
		
		<th>code_postal</th>
		
		<th></th>
	</tr>
	<?php if($this->tVille):?>
		<?php foreach($this->tVille as $oVille):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oVille->nom ?></td>
		
		<td><?php echo $oVille->code_postal ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('ville::edit',array(
										'id'=>$oVille->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('ville::delete',array(
										'id'=>$oVille->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('ville::show',array(
										'id'=>$oVille->getId()
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

<p><a class="btn btn-primary" href="<?php echo $this->getLink('ville::new') ?>">New</a></p>
			
