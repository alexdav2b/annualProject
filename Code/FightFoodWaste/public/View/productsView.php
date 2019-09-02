<?php

// require_once __DIR__ . '/../../Model/Product.php';

$scripts = array();


ob_start();
?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Barcode</th>
            <th>ValidDate</th>
            <th>Depot</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach ($products as $product){ ?>
        <tr>
            <th> <?= $product->getId(); ?></th>
            <th> <?= $product->getName(); ?></th>
            <th> <?= $product->getBarcode(); ?></th>
            <th> <?= $product->getValidDate(); ?></th>
            <th> <?=  $depot->getNumero() . $depot->getRue() .$depot->getPostcode() .$depot->getArea() . $depot->getCapacity() ?></th>
            <th id =<?= $product->getId();?> ><select id="statutId" class ="form-control col-md-7 inline col-lg-7" onchange = 'ChoseStatutProduit(this)'>
        <?php foreach ($statuts as $statut){ ?>
            <?php $bool = $statut->getId() ==$product->getStatut()->getId(); ?>
            <option <?= $bool ? 'selected' : '' ?> value = '<?= $statut->getId() ?>'><?= $statut->getName(); ?></option>
        <?php } ?>
            </select>
                </th>
        </tr>
    <?php }
     ?>
    </tbody>
</table>
<?php 

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/templateGestionView.php';

?>