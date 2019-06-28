<?php

$title = 'NouvelItineraire';
$script = "map.js";

ob_start();
?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Itineraire</h2>

    <form action="/itineraire" method="post" enctype="multipart/form-data" >
        <label for="site">Choix du site :</label>
    
        <select id="site" name="site" >
            <option value="">--Choisie--</option>
            <?php
            foreach($site_data as $site){
                echo "<option value=".$site->ID.">".$site->Name."</option>";
            }
            ?>
        </select>
        <br>
    
        <label for="date">Choix de la date :</label>
        <input type="datetime-local" name="date" id="date">
        <br>
        <input type="submit" value="Valider">
    </form>
</div>
<?php


$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';

?>