
<?php 
    $Info = $this->tInfo;
    $Prenom = $Info->prenom;
    $Nom = $Info->nom;
    $Birthday = $Info->date_de_naissance;
    $Adresse = $Info->adresse;
    $Email = $Info->email;
    $Pseudo = $Info->email;
    $Abonnement = $Info->Abonnement;
    $Id_Bouton = $Info->id_bouton;
    $sSituation = 'Super Admin';    
?>
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                                    <img src="css/images/profil/<?php echo $Prenom.' '.$Nom.'.jpg';?> " class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                                                <label>
                                                    <?php 
                                                        echo $Prenom.' '.$Nom;
                                                    ?>
                                                </label>
					</div>
					<div class="profile-usertitle-job">
                                                    <?php 
                                                        echo $sSituation;
                                                    ?>
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follower</button>
					<button type="button" class="btn btn-danger btn-sm">Change Photo</button>
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
							<a href="<?php echo $this->getLink("utilisateur::edit"); ?>">
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
                <p> Prenom : <?php echo $Prenom; ?></p>
                <p> Nom : <?php echo $Nom; ?></p>
                <p> Anniversaire : <?php echo $Birthday; ?></p>
                <p> Adresse : <?php echo $Adresse; ?></p>
                <p> Pseudo : <?php echo $Pseudo; ?></p>
                <p> Email : <?php echo $Email; ?></p>
                <p> Abonnement : <?php echo $Abonnement; ?></p>
                <p> Casier réservé : <?php echo $Id_Bouton; ?></p>
                <p> Situation : <?php echo $sSituation; ?></p>
                
            </div>
		</div>
	</div>
</div>
<center>
<strong>Powered by <a href="http://j.mp/metronictheme" target="_blank">KeenThemes</a></strong>
</center>
<br>
<br>