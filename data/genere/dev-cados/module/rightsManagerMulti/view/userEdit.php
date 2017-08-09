<?php 
/*
 examplemodule
 * 
 exampleUser_login
exampleUser_groupsId

 * */


$oForm=new plugin_form($this->oUser);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" >

<table class="table table-striped">
	
	<tr>
		<th>Login</th>
		<td><?php echo $this->oUser->email?></td>
	</tr>
	<tr>
		<th>Groupe</th>
		<td>
			<?php foreach($this->tJoinGroup as $sKey => $sName):?>

				<label><input type="checkbox" <?php if(in_array($sKey, $this->tGroup)):?>checked="checked"<?php endif;?> name="groups_id[]" value="<?php echo $sKey?>"><?php echo $sName?></label><br/>
			<?php endforeach;?>
		</td>
	</tr>

</table>

<p>
	<input class="btn btn-success" type="submit" value="Modifier" /> <a class="btn btn-link" href="<?php echo $this->getLink('rightsManagerMulti::list')?>">Annuler</a>
</p>

<?php echo $oForm->getToken('token',$this->token)?>

</form>
