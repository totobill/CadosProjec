<form action="" method="POST" role="form">
    <?php echo $this->tMessage['date_limite']; ?>
    <div class="row">
        
        <?php foreach ($this->oCasier as $casier){ ?>
            <?php if ($casier->etat == 1) { ?>
                <div class="reservation_reserver_casier col-xs-6 col-lg-2">
                    <button class="casier_reserver" type="button" value='<?php echo $casier->numero; ?>' name="num_bouton">    
                        <img class="casier_reserver" src="css/images/casier_reserver.png" alt="Responsive image">
                        <?php echo $casier->numero; ?>
                    </button>

                </div>
            <?php }else{ ?>
                <div class="reservation_reserver_casier col-xs-6 col-lg-2">
<!--                        <img class="casier_libre" src="css/images/casier_libre.png" alt="Responsive image">
                        <button class="casier_libre" type="submit" value='//<?php //echo $casier->numero; ?>' name="num_bouton">-->
                            
                    <button class="casier_libre" type="submit" value='<?php echo $casier->numero; ?>' name="num_bouton">    
                            <img class="casier_libre" src="css/images/casier_libre.png" alt="Responsive image">
                            <?php echo $casier->numero; ?>
                    </button>    
                            
                </div>
            <?php } ?> 
        <?php } ?>
    </div>
</form>
