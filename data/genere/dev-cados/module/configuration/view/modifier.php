<?php 
$oForm=new plugin_form($this->oUtilisateur);
$oForm->setMessage($this->tMessage);
?>
<div class="container">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo $this->oUtilisateur->profilPicture ?>" class="img-responsive" alt="Photo de profil">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                                <label>
                                    <?php 
                                        echo $this->oUtilisateur->prenom.' '.$this->oUtilisateur->nom;
                                    ?>
                                </label>
                        </div>
                        <div class="profile-usertitle-job">
                                    <?php 
                                        echo $this->oUtilisateur->situation;
                                    ?>
                        </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follower</button>
                        <button type="button" class="btn btn-danger btn-sm">Changer Photo</button>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                            <li class="active">
                                    <a href="<?php echo $this->getLink("configuration::profil"); ?>">
                                    <i class="glyphicon glyphicon-home"></i>
                                    Vue d'Ensemble </a>
                            </li>
                            <li>
                                    <a href="<?php echo $this->getLink("configuration::edit",array('id'=>$this->oUtilisateur->getId())); ?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Modification Profil </a>
                            </li>
                            <li>
                                    <a href="<?php echo $this->getLink("configuration::rappel"); ?>" target="_blank">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Rappel </a>
                            </li>
                            <li>
                                    <a href="<?php echo $this->getLink("configuration::help"); ?>">
                                    <i class="glyphicon glyphicon-flag"></i>
                                    Aide </a>
                            </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <form class="form-horizontal" action="" method="POST" >

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Nom</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputText('nom',array('class'=>'form-control')) ?></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Prénom</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputText('prenom',array('class'=>'form-control')) ?></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Date de naissance</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputDate('date_de_naissance',array('class'=>'form-control')) ?></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Numero</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputText('numero',array('class'=>'form-control')) ?></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputEmail('email',array('class'=>'form-control')) ?></div>
                        </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Pseudo</label>
                                <div class="col-sm-10"><?php echo $oForm->getInputText('pseudo',array('class'=>'form-control')) ?></div>
                        </div>

                        <?php echo $oForm->getInputHidden('password',array('class'=>'form-control')) ?></div>


                    <?php echo $oForm->getToken('token',$this->token)?>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-success" value="Modifier" /> <a class="btn btn-link" href="<?php echo $this->getLink('configuration::modifierPassword',array('id'=>$this->oUtilisateur->getId()))?>">Changer de Mot de passe</a> <a class="btn btn-link" href="<?php echo $this->getLink('configuration::profil')?>">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
