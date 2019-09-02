<?php

$title = 'Nouvel Itineraire';
$scripts = array();

// array_push($scripts, 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.52.0/mapbox-gl.js');
// array_push($scripts, "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE . "&callback=initMap");
array_push($scripts, "../js/Delivery.js");

// array_push($scripts,"../js/Itineraire.js");


ob_start();
?>
<div id ="fin" class = "col-md-4 col-lg-4" style= "height:100%">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Itineraire</h2>
    <!-- <form  class = 'row form-group container' > -->

        <div id = "itineraire" class="col-md-12 col-lg-12 row">

                
            <div id = "type" class="col-md-12 col-lg-12 row">
                <label for = "typeId" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Type</label>
                <select onchange="ChoseType()" class="form-control inline col-md-8 col-lg-8 inline" id="typeId" name="type" >
                <option >--Choisir--</option>
                    <?php
                    foreach($types as $s){ ?>
                        <option  value = <?= $s->getId()?> > <?php if($s->getId() == 1){ echo "Collecte"; }elseif($s->getId() == 2){ echo "Livraison "; } ?> </option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
    <!-- </form> -->
    <div class="col-md-12 col-lg-12 row" id='valider1'></div>
</div>
<div class = "col-md-7 offset-md-1 col-lg-7 offset-lg-1" style= "height:100%">
    <div id = "stop" class = "col-md-12 col-lg-12" style= "height:100%"></div>
</div>
<?php


$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';

?>