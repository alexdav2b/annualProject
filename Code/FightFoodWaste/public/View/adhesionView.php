<?php

require_once __DIR__ . '/../../Model/User.php';
$title = "FightFoodWaste - Adhésions";
$scripts = array(); 
array_push($scripts, "https://www.paypal.com/sdk/js?client-id=sb&currency=EUR");
array_push($scripts, "/../js/paypal.js");

ob_start();
?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-md-6 offset-md-4 col-lg-6 offset-lg-4">Adhesions</h2>
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
            <tr id = "all">
                <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>
                <th><a href = <?= $url ?> class = "btn btn-success" id = "Create">Voir PDF</a></th> 
            </tr>
            <?php }
        }else{ ?>
            <tr id = "one">
                <th> <?= $adhesion->getId(); ?></th>
                <th> <?= $adhesion->getDate(); ?></th>
                <th> <?= $adhesion->getUser()->getName(); ?> </th>    
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php  if($btn){?>
        
        <button id = 'validate'  onclick='Paypal()'  class = "btn btn-success col-md-4 offset-md-4 col-lg-4 offset-lg-4" id = "Create" style='margin-bottom : 1em;'>
        Adhérer ?
        </button>
        <p>Rejoignez-nous pour seulement 100€ par an à partir du <?= $dateToPost->format('Y-m-d'); ?></p>
        <div class = 'offset-md-2 offset-lg-2 col-md-8 col-lg-8 inline ' style = 'margin-top : 1em;' id="paypal-button-container"></div>

    <?php  } ?>
</div>
<?php 

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>