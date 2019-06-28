<?php

$title = 'NouvelItineraire';
$script = "map.js";

ob_start();
?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Itineraire</h2>

    <form action="/itineraire" method="post" enctype="multipart/form-data" class = 'row form-group' >
        <label for = "site" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Choix du site</label>
        <select class="form-control inline col-md-8 col-lg-8 inline" id="site" name="site" >
            <option value="">--Choisie--</option>
            <?php
            foreach($site_data as $site){
                echo "<option value=".$site->ID.">".$site->Name."</option>";
            }
            ?>
        </select>
        <br>
    
        <label for="date" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'">Choix de la date</label>
        <input class = 'form-control col-md-8 col-lg-8 inline' type="datetime-local" name="date" id="date">
        <br><br>
        <input class='btn btn-success col-md-2 col-lg-2 offset-md-4 offset-lg-4' type="submit" value="Valider">
    </form>
</div>
<?php


$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';

?>