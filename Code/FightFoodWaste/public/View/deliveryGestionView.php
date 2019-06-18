<?php

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Model/Truck.php';
require_once __DIR__ . '/../../Model/DeliveryType.php';

require_once __DIR__ . '/../../Control/Form.php';

$title = "FightFoodWaste - Login";

ob_start();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>N°</th>
            <th>Type</th>
            <th>Start</th>
            <th>End</th>
            <th>Truck</th>
            <th>Employee</th>
        </tr>
    </thead>
    <tbody>

    <?php
    if(isset($deliveries)){
        foreach ($deliveries as $delivery){
            ?>
        <tr>
            <th> <?= $delivery->getId(); ?></th>
            <th> <?= $delivery->getType()->getName(); ?></th>
            <th> <?= $delivery->getDateStart(); ?></th>
            <th> <?= $delivery->getDateEnd(); ?></th>
            <th> <?= $delivery->getTruck()->getPlate(); ?></th>
            <th> <?= $delivery->getUser()->getName(); ?></th>        
        </tr>
        <?php }
    }else{ ?>
        <tr>
            <th> <?= $delivery->getId(); ?></th>
            <th> <?= $delivery->getType()->getName(); ?></th>
            <th> <?= $delivery->getDateStart(); ?></th>
            <th> <?= $delivery->getDateEnd(); ?></th>
            <th> <?= $delivery->getTruck()->getPlate(); ?></th>
            <th> <?= $delivery->getUser()->getName(); ?></th>        
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php 

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/templateGestionView.php';

?>