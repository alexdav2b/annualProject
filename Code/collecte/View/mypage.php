<?php


$json_site = file_get_contents('http://apipa/site');
$site_data = json_decode($json_site);

?>

<form action="itineraire.php" method="post" enctype="multipart/form-data" >
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

