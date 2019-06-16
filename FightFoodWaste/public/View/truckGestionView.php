<?php

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Control/Form.php';

$title = "FightFoodWaste - Login";
$script = "../js/connexionView.js";

ob_start();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Plate</th>
            <th>Capacity (Products)</th>
            <th>Site</th>
            <th>Adresse</th>
        </tr>
    </thead>
    <tbody>

    <?php
    if(isset($objects)){
        foreach ($objects as $object){
            $site = $object->getSite();
            ?>
        <tr>
            <th> <?= $object->getName(); ?></th>
            <th> <?= $object->getPlate(); ?></th>
            <th> <?= $object->getCapacity(); ?></th>
            <th> <?= $site->getName(); ?> </th>
            <th> <?= $site->getNumero() . ', ' .  $site->getRue() . ' ' . $site->getPostcode() . ' ' . $site->getArea() ?> </th>
        </tr>
        <?php }
    }else{ 
        $site = $object->getSite(); ?>
        <tr>
            <th> <?= $object->getName(); ?></th>
            <th> <?= $object->getPlate(); ?></th>
            <th> <?= $object->getCapacity(); ?></th>
            <th> <?= $site->getName(); ?> </th>
            <th> <?= $site->getNumero() . ', ' .  $site->getRue() . ' ' . $site->getPostcode() . ' ' . $site->getArea() ?> </th>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php 

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/templateGestionView.php';

?>