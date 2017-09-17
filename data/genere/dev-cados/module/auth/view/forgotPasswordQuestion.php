<h1 class="form-signing-heading">Réinitialisation mot de passe</h1>
<?php $oForm=new plugin_form($this->email);
$oForm->setMessage($this->tMessage);
?>
<form action="" method="POST" class="form-signin form-signin-inscription" role="form">
            <p>
               <label>Email :</label>
               <?php echo $oForm->getInputEmail('email')?>
               
            </p>
            <p>
               <label>Votre question secrète : <?php echo $this->sQuestion ?></label>
            </p>
            <p>
               <label>Réponse :</label>
               <?php echo $oForm->getInputText('answer',array('class'=>'form-control'),false)?>
            </p>
           <input class="btn btn-lg btn-primary btn-block" type="submit" value="Vérification" />
           <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::forgotPasswordEmail')?>">Retour</a>
           <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::login')?>">Annuler</a>

</form>