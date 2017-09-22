<?php


$oUserUndelivery = model_utilisateur::getInstance()->getAllReservationActive();

foreach ($oUserUndelivery as $oUser){
    $oUser->nbr_jour_reservation += 1;
    $oUser->save();
}
