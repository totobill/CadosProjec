<!--<form action="" method="POST"  class="form-signin" role="form">
	 <h2 class="form-signin-heading">Authentification</h2>
	 
	<input class="form-control" placeholder="Nom d'utilisateur" type="text" name="login" autocomplete="off"/>
	<input class="form-control" placeholder="Mot de passe" type="password" name="password" autocomplete="off"/>
	
	<input type="submit" value="Se connecter"  class="btn btn-lg btn-primary btn-block"/> <a class="btn btn-link" href="<?/*php echo _root::getLink('auth::inscription')*/?>">S'inscrire</a></p>

	//<?php // if($this->sError!=''):?>
		<p style="color:red"><?php // echo $this->sError?></p>
	<?php // endif;?>
</form>-->


<?php if(isset($this->sConfirmation) and $this->sConfirmation!=''){?>
		
	<form action="" method="POST"  class="form-signin form-signin-login" role="form">
		<h2 class="form-signin-heading">Authentification</h2>
		 
		<input class="form-control" placeholder="Nom d'utilisateur" type="text" name="login" value="<?php echo $this->sEmail ?>"autocomplete="off"/>
		<input class="form-control" placeholder="Mot de passe" type="password" name="password" autocomplete="off"/>
		
	        <input type="submit" value="Se connecter"  class="btn btn-lg btn-primary btn-block"/> <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::inscription')?>">S'inscrire</a></p>
	
		<?php if(isset($this->sError) and $this->sError!=''):?>
			<p style="color:red"><?php echo $this->sError?></p>
		<?php endif;?>
		<p style="color:red"><?php echo $this->sConfirmation?></p>
	</form>
		
		
		
<?php }else{?>


	<form action="" method="POST"  class="form-signin form-signin-login" role="form">
		<h2 class="form-signin-heading">Authentification</h2>
		 
		<input class="form-control" placeholder="Nom d'utilisateur" type="text" name="login" autocomplete="off"/>
		<input class="form-control" placeholder="Mot de passe" type="password" name="password" autocomplete="off"/>
		
	        <input type="submit" value="Se connecter"  class="btn btn-lg btn-primary btn-block"/> <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::inscription')?>">S'inscrire</a></p>
	
		<?php if(isset($this->sError) and $this->sError!=''):?>
			<p style="color:red"><?php echo $this->sError?></p>
		<?php endif;?>
		<?php if(isset($this->tMessage) and isset($this->tMessage['success'])):?>
                    <p><?php echo implode($this->tMessage['success'])?> </p>
                <?php endif;?>
	</form>
	
<?php }?>
