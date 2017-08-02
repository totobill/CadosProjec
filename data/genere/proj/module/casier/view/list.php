<table class="table table-striped">
	<tr>
		
		<th>numero</th>
		
		<th>etat</th>
		
		<th>id_utilisateur</th>
		
		<th></th>
	</tr>
	<?php if($this->tCasier):?>
		<?php foreach($this->tCasier as $oCasier):?>
		<tr <?php echo plugin_tpl::alternate(array('','class="alt"'))?>>
			
		<td><?php echo $oCasier->numero ?></td>
		
		<td><?php echo $oCasier->etat ?></td>
		
		<td><?php echo $oCasier->id_utilisateur ?></td>
		
			<td>
				
				
<a class="btn btn-success" href="<?php echo $this->getLink('casier::edit',array(
										'id'=>$oCasier->getId()
									) 
							)?>">Edit</a>
			| 
<a class="btn btn-danger" href="<?php echo $this->getLink('casier::delete',array(
										'id'=>$oCasier->getId()
									) 
							)?>">Delete</a>
			| 
<a class="btn btn-default" href="<?php echo $this->getLink('casier::show',array(
										'id'=>$oCasier->getId()
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

<p><a class="btn btn-primary" href="<?php echo $this->getLink('casier::new') ?>">New</a></p>
			
