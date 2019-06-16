<?php 

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Control/Form.php';

?>

<form action = "OnInscription()" method = "post"> 
        <div class = 'row form-group col-md-12' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <input class = "form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = 'Surname'>
            <input class = "form-control" type = "text" name = 'Name' id = 'NameID' placeholder = 'Name'>
            <input class = "form-control" type = "text" name = 'Email' id = 'EmailID' placeholder = 'Email@host.com'>
            <label for = "Site" class = 'col-md-3 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control col-md-9 inline" id = "Site">     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <input class = "form-control col-md-2 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = 'N°'>
            <input class = "form-control col-md-9 offset-md-1 inline" type = "text" name = 'Rue' id = 'Rue' placeholder = 'Rue'>
            <input class = 'form-control' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>
            <input class = 'form-control' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>
            <label for = "Eligibility" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Adherent</label>
            <select class="form-control col-md-8 inline" id = "Eligibility">     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <p class = 'col-md-6 offset-md-3'><button class = "btn btn-success" id = "Inscription" type = "submit" value = "Inscription">Sign In</button></p>
        </div>
    </form> 

<?php 

require_once __DIR__ . '/connexionView.php';
?>
