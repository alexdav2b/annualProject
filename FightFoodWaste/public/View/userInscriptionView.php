<?php

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Control/Form.php';

$title = "Login";
ob_start();
?>
<div id = "inscriptionForm" class = "formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2>Inscription</h2>
    <form action = "OnInscription()" method = "post"> 
        <?php
        $inscription = new Form(array('Name', 'Surname', 'Email', 'Password', 'Address', 'Postcode', 'Area', 'Eligibility')); 
        echo $inscription->input('Name');
        echo $inscription->input('Surname');
        echo $inscription->input('Email');
        echo $inscription->input('Password');
        echo $inscription->input('Address');
        ?>
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <input class = 'form-control col-md-6 inline' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>
            <input class = 'form-control col-md-6 inline' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>
        </div>
        <!-- echo $inscription->input('Postcode');
        echo $inscription->input('Area'); -->
        <?php echo $inscription->input('Eligibility'); ?>
        <?php echo $inscription->submit('Inscription'); ?>
    </form> 
</div>

<?php

$inscription = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>