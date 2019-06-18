<?php

require_once __DIR__ . '/../../Model/User.php';

$title = "FightFoodWaste - Login";
$script = "../js/connexionView.js";

ob_start();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Date</th>
            <th>Débiteur</th>
        </tr>
    </thead>
    <tbody>

    <?php
    if(isset($adhesions)){
        foreach ($adhesions as $adhesion){
            ?>
        <tr>
            <th> <?= $adhesion->getId(); ?></th>
            <th> <?= $adhesion->getDate(); ?></th>
            <th> <?= $adhesion->getUser()->getName(); ?> </th>    
        </tr>
        <?php }
    }else{ ?>
        <tr>
            <th> <?= $adhesion->getId(); ?></th>
            <th> <?= $adhesion->getDate(); ?></th>
            <th> <?= $adhesion->getUser()->getName(); ?> </th>    
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php 

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/templateGestionView.php';

?>