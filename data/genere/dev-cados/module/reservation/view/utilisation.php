<?php 
    $InfoReservation = $this->infoReservation;
    $sMessage = $this->sMessage;
    $Numero = $InfoReservation->id_bouton; 
?>
<form action="" method="POST">
    <div class="reservation_principale">
        <div class="reservation_utilisation_logo col-xs-12">
            <img class="casier_choisit" src="css/images/casier_choisit.png" alt="Responsive image">
        </div>
        <div class="reservation_utilisation_casier col-xs-12">
            <p class="reservation_utilisation_titre"><b>Casier Choisit :</b></p>
            <p class="reservation_utilisation_attribut">numero <?php echo $Numero ?> </p>
        </div>
        <div class="reservation_utilisation_casier col-xs-12">
            <p class="reservation_utilisation_titre"><b>Heure du début de réservation :</b></p>
            <p class="reservation_utilisation_attribut"><?php echo $this->oCasier->start_location?></p>
        </div>
        <div class="reservation_utilisation_casier col-xs-12">
            <p class="reservation_utilisation_titre"><b>Heure de fin de réservation :</b></p>
            <p class="reservation_utilisation_attribut">En attente ...</p>
        </div>
        <div class="reservation_utilisation_casier col-xs-12">
            <p><?php echo $sMessage; ?></p>
        </div>
        <div class="reservation_utilisation_button col-xs-6">
            <button type="submit" name="ouvrir" class="btn btn-primary">Ouvrir</button>
        </div>
        <div class="reservation_utilisation_button col-xs-6">
            <button type="submit" name="vider" class="btn btn-primary">Vider</button>
        </div>
    </div>
</form>
