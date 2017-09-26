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
                        <a href="<?php echo $this->getLink("configuration::modifierPhoto",array('id'=>$this->oUtilisateur->getId())); ?>"><button type="button" class="btn btn-danger btn-sm">Changer Photo</button></a>
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
                                    <a href="<?php echo $this->getLink("configuration::modifier", array('id'=>$this->oUtilisateur->getId())); ?>">
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
                <form action="" method="POST" enctype="multipart/form-data">
                    Photo de profil : <input type="file" name="profilPicture" />

                    <?php if($this->oUtilisateur->profilPicture!=''):?>
                    <img src="<?php echo $this->oUtilisateur->profilPicture ?>" />
                    <?php endif;?>

                    <input type="submit" value="Sauvegarder"/>

                </form>
            </div>
        </div>
    </div>
</div>