<h1 class="form-signing-heading">Réinitialisation mot de passe</h1>
<?php $oForm=new plugin_form($this->oUser);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" class="form-signin form-signin-inscription" role="form">
            <p>
               <?php echo $oForm->getInputHidden('email',array('class'=>'form-control'))?>
            </p>
            <p>
               <label>Mot de passe</label>
               <?php echo $oForm->getInputPassword('password', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Confirmez le mot de passe</label>
               <?php echo $oForm->getInputPassword('confirmationPassword', array('class'=>'form-control'))?>
           </p>
            
           <input class="btn btn-lg btn-primary btn-block" type="submit" value="Valider" />
           <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::login')?>">Annuler</a>

</form>