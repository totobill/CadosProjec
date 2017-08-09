<?php $oAllUser = $this->oAllUser; ?>
<div class="row">
    <div class="communaute_affichage_deco col-lg-4 col-xs-4">
            Connecté / Déconnecté
    </div>
    <div class="communaute_affichage_prenom col-lg-4 col-xs-4">
            Prénom
    </div>
    <div class="communaute_affichage_nom col-lg-4 col-xs-4"> 
            Nom
    </div>
    <?php foreach($oAllUser as $oUser){ ?> 
        <?php if($oUser->connecte == 1){ ?>
            <div class="ligne_co col-lg-12 col-xs-12">    
                <div class="communaute_affichage_co col-lg-4 col-xs-4">
                        <span class="glyphicon glyphicon-ok-circle"></span>
                </div>
                <div class="communaute_affichage_prenom col-lg-4 col-xs-4">
                        <?php echo $oUser->prenom;?>
                </div>
                <div class="communaute_affichage_nom col-lg-4 col-xs-4"> 
                        <?php echo $oUser->nom; ?>
                </div>
            </div>
        <?php }else{ ?>
            <div class="ligne_deco col-lg-12 col-xs-12">    
                <div class="communaute_affichage_deco col-lg-4 col-xs-4">
                        <span class="glyphicon glyphicon-remove-circle"></span>
                </div>
                <div class="communaute_affichage_prenom col-lg-4 col-xs-4">
                        <?php echo $oUser->prenom;?>
                </div>
                <div class="communaute_affichage_nom col-lg-4 col-xs-4"> 
                        <?php echo $oUser->nom; ?>
                </div>
            </div>     
        <?php } ?>
    <?php } ?>
</div>