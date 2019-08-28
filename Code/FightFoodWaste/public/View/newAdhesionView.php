<?php
$title = 'FightFoodWaste - Adhérer';
$scripts = array();
array_push($scripts, "https://www.paypal.com/sdk/js?client-id=sb&currency=EUR");
array_push($scripts, "/../js/paypal.js");


ob_start();

?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-md-6 offset-md-4 col-lg-6 offset-lg-4">Adhérer</h2>
    <p>Rejoignez-nous pour seulement 100€ par an</p>

    <div class = 'offset-md-2 offset-lg-2 col-md-8 col-lg-8 inline ' style = 'margin-top : 1em;' id="paypal-button-container"></div>

</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';