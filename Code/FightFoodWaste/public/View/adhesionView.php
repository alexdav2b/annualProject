<?php

require_once __DIR__ . '/../../Model/User.php';

$title = "FightFoodWaste - Login";
$script = "../js/connexionView.js";

ob_start();
?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-md-6 offset-md-4 col-lg-6 offset-lg-4">Adhérer</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>Date</th>
                <th>Débiteur</th>
                <th>Facture</th>
            </tr>
        </thead>
        <tbody>

        <?php
        if(isset($adhesions)){
            foreach ($adhesions as $adhesion){
                $adhesionId = $adhesion->getId();
                $url ="/adhesion/Facture/$adhesionId";
                ?>
            <tr>
                <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>
                <th><a href = <?= $url ?> class = "btn btn-success" id = "Create">Voir PDF</a></th> 
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
    <a href = "/adhesion" class = "btn btn-success col-md-4 offset-md-4 col-lg-4 offset-lg-4" id = "Create" style='margin-bottom : 1em;'>Adhérer</a>
</div>
<?php 

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>