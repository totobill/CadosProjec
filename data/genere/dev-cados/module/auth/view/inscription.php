<h1 class="form-signing-heading">Inscription</h1>
<?php $oForm=new plugin_form($this->oUser);
$oForm->setMessage($this->tMessage);
$oForm2=new plugin_form($this->tQuestions);
$oForm2->setMessage($this->tMessage);
?>
<form action="" method="POST" class="form-signin form-signin-inscription" role="form">
  
            <p>
               <label>Email</label>
               <?php echo $oForm->getInputEmail('email',array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Mot de passe</label>
               <!--<input type="password" name="password" class="form-control" />-->
               <?php echo $oForm->getInputPassword('password', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Confirmez le mot de passe</label>
<!--               <input type="password" name="password2" class="form-control"/>-->
               <?php echo $oForm->getInputPassword('confirmationPassword', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Prénom</label>
               <!--<input type="text" name="prenom" class="form-control"/>-->
               <?php echo $oForm->getInputText('prenom', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Nom</label>
               <!--<input type="text" name="nom" class="form-control"/>-->
               <?php echo $oForm->getInputText('nom', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Date de naissance</label>
               <!--<input type="date" name="date_de_naissance" class="form-control"/>-->
               <?php echo $oForm->getInputDate('date_de_naissance', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Question secrète :</label>
               <?php echo $oForm2->getSelect('questionSecrete', array('class'=>'form-control'))?>
           </p>
           <p>
               <label>Réponse :</label>
               <!--<input type="date" name="date_de_naissance" class="form-control"/>-->
               <?php echo $oForm->getInputText('answer', array('class'=>'form-control'))?>
           </p>
   
   <p><input class="btn btn-lg btn-primary btn-block" type="submit" value="S'enregistrer" /> <a class="btn btn-lg btn-primary btn-block" href="<?php echo _root::getLink('auth::login')?>">Login</a> </p>

</form>
   

   
