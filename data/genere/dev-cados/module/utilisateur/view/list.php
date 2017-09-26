<table class="table">
	<tr>
		
		<th>Nom</th>
		
		<th>Prénom</th>
		
		<th>Date de naissance</th>
		
		<th>Numero</th>
		
		<th>Email</th>
		
		<th>Pseudo</th>
		
		<th>Casier réserver</th>
		
		<th>Connecté ?</th>
                
                <th>Nombre de jour sans rendre le casier</th>
                
                <th colspan="3">Action sur Utilisateur</th>
		
		<th></th>
	</tr>
	<?php if($this->tUtilisateur):?>
		<?php foreach($this->tUtilisateur as $oUtilisateur):?>
                    <?php switch ($oUtilisateur->nbr_jour_reservation){
                        case 0:
                            $color = 'table_vert';
                            break;
                        case 1:
                            $color = 'table_jaune';
                            break;
                        case 2:
                            $color = 'table_orange';
                            break;
                        case 3:
                            $color = 'table_rouge';
                            break;
                        default:
                            $color = 'table_noir';
                            break;
                    }
                    ?>
                    <tr <?php /*echo plugin_tpl::alternate(array('','class="alt"'))*/?> class="<?php  echo $color;?>">

                            <td><?php echo $oUtilisateur->nom ?></td>

                            <td><?php echo $oUtilisateur->prenom ?></td>

                            <td><?php echo $oUtilisateur->date_de_naissance ?></td>

                            <td><?php echo $oUtilisateur->numero ?></td>

                            <td><?php echo $oUtilisateur->email ?></td>

                            <td><?php echo $oUtilisateur->pseudo ?></td>

                            <td><?php switch ($oUtilisateur->id_bouton){
                                case 0:
                                    echo "aucun";
                                    break;
                                default:
                                    echo $oUtilisateur->id_bouton;
                                    break;
                            }?></td>

                            <td><?php switch ($oUtilisateur->connecte){
                                case 0:
                                    echo "Non";
                                    break;
                                case 1:
                                    echo "Oui";
                                    break;
                                }?></td>


                            <td><?php echo $oUtilisateur->nbr_jour_reservation ?></td>

                            <td colspan="3">
                                <a class="btn btn-success" href="<?php echo $this->getLink('utilisateur::edit',array('id'=>$oUtilisateur->getId()))?>">Editer</a>
                                                        | 
                                <a class="btn btn-danger" href="<?php echo $this->getLink('utilisateur::delete',array('id'=>$oUtilisateur->getId()) )?>">Supprimer</a>
                                                        | 
                                <a class="btn btn-default" href="<?php echo $this->getLink('utilisateur::show',array('id'=>$oUtilisateur->getId()) )?>">Afficher</a>
                            </td>
                    </tr>	
                <?php endforeach;?>
	<?php else:?>
            <tr>
                <td colspan="13">Aucun utilisateurs</td>
            </tr>
	<?php endif;?>
</table>

<p><a class="btn btn-primary" href="<?php echo $this->getLink('utilisateur::new') ?>">New</a></p>
			
