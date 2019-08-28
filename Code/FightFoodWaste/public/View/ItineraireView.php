<?php

$title = 'NouvelItineraire';
$scripts = array();
// array_push($scripts,"../js/map.js");
array_push($scripts,"../js/Itineraire.js");

ob_start();
?>
<div  class = "col-md-4 col-lg-4" style= "height:100%">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Itineraire</h2>
    <form  class = 'row form-group container' >

        <div id = "itineraire" class="col-md-12 col-lg-12 row">
            <div class="col-md-12 col-lg-12 row">
                <label for="date" class = 'inline col-md-5 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'">Date</label>
                <input class = 'form-control col-md-4 col-lg-4 inline' type="time" name="hout" id="hour">
                <input class = 'form-control col-md-4 col-lg-4 inline' type="date" name="date" id="date">

                <!-- <input class = 'form-control col-md-8 col-lg-8 inline' type="datetime-local" name="date" id="date"> -->
            </div>
                
            <div id = "site" class="col-md-12 col-lg-12 row">
                <label for = "siteId" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
                <select onchange="ChoseSite()" class="form-control inline col-md-8 col-lg-8 inline" id="siteId" name="site" >
                <option >--Choisir--</option>
                    <?php
                    foreach($sites as $s){ ?>
                        <option  value = <?= $s->getId()?> > <?= $s->getName()?> </option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        
    </form>
    <div class="col-md-12 col-lg-12 row" id='validerDelivery'></div>
    
</div>
<div  class = "col-md-7 offset-md-1 col-lg-7 offset-lg-1" style= "height:100%">

</div>
<?php


$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';

?>