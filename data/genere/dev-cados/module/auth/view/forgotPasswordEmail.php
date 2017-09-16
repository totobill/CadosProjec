<h1 class="form-signing-heading">Réinitialisation mot de passe</h1>
<?php $oForm=new plugin_form($this->oUser);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" class="form-signin form-signin-inscription" role="form">
            <p>
               <label>Email :</label>
               <?php echo $oForm->getInputEmail('email',array('class'=>'form-control'))?>

           <input class="btn btn-lg btn-primary btn-block" type="submit" value="Valider" />
           <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::login')?>">Login</a>

</form>