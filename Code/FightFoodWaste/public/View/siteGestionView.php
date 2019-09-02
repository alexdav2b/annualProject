<?php

require_once __DIR__ . '/../../Model/Site.php';

$scripts = array();


ob_start();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>N°</th>
            <th>Rue</th>
            <th>Postcode</th>
            <th>Area</th>
            <th>Capacity</th>
        </tr>
    </thead>
    <tbody>

    <?php
    if(isset($sites)){
        foreach ($sites as $site){ ?>
        <tr>
            <th><a href= '<?= "/site/".$site->getId() ?>'> <?= $site->getName(); ?></a></th>
            <th> <?= $site->getNumero(); ?></th>
            <th> <?= $site->getRue(); ?></th>
            <th> <?= $site->getPostcode(); ?></th>
            <th> <?= $site->getArea(); ?></th>
            <th> <?= $site->getCapacity(); ?> </th>
        
        </tr>
        <?php }
    }else{ ?>
        <tr>
        <th> <?= $site->getName(); ?></th>
            <th> <?= $site->getNumero(); ?></th>
            <th> <?= $site->getRue(); ?></th>
            <th> <?= $site->getPostcode(); ?></th>
            <th> <?= $site->getArea(); ?></th>
            <th> <?= $site->getCapacity(); ?> </th>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php 

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/templateGestionView.php';

?>