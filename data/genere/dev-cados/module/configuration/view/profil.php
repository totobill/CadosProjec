
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
                        <a href="<?php echo $this->getLink("configuration::modifierPhoto",array('id'=>$this->oUtilisateur->getId())); ?>"><button type="button" class="btn btn-danger btn-sm">Change Photo</button></a>
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
               <form class="form-horizontal" action="" method="POST" >
                    <div class="form-group">
                            <label class="col-sm-2 control-label">nom</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->nom ?>
                                <input type="hidden" name="id" value="<?php echo $this->oUtilisateur->id_utilisateur;?>">
                            </div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">prenom</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->prenom ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">date de naissance</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->date_de_naissance ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">numero</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->numero ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">email</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->email ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">pseudo</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->pseudo ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">password</label>
                            <!--<div class="col-sm-10"><?php //echo $this->oUtilisateur->password ?></div>-->
                            <div class="col-sm-10">***********</div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">Abonnement</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->Abonnement ?></div>
                    </div>

                    <div class="form-group">
                            <label class="col-sm-2 control-label">N° Casier réservé</label>
                            <div class="col-sm-10"><?php echo $this->oUtilisateur->id_bouton ?></div>
                    </div>
                </form>   
            </div>
        </div>
    </div>
</div>
<center>
<strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
</center>
<br>
<br>
