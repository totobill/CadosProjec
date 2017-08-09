<form action="" method="POST" role="form">
    <div class="row">
        <?php foreach ($this->oCasier as $casier){ ?>
            <?php if ($casier->etat == 1) { ?>
                <div class="reservation_reserver_casier col-xs-6 col-lg-2">
                    <a href="#">
                        <img class="casier_reserver" src="css/images/casier_reserver.png" alt="Responsive image">
                        <input class="casier_reserver" type="submit" value='<?php echo $casier->numero; ?>' name="num_bouton">
                    </a>
                </div>
            <?php }else{ ?>
                <div class="reservation_reserver_casier col-xs-6 col-lg-2">
                    <a href="#">
                        <img class="casier_libre" src="css/images/casier_libre.png" alt="Responsive image">
                        <input class="casier_libre" type="submit" value='<?php echo $casier->numero; ?>' name="num_bouton">
                    </a>
                </div>
            <?php } ?> 
        <?php } ?>
    </div>
</form>