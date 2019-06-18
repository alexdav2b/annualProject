<?php
ob_start();
?>
<div class = "col-md-6 offset-md-3">
    <h2>Votre Compte</h2>
    <form action = "/log/Individual" method = "put" id = 'Individual' > 
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <label for = "Surname" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = 'Firstname'>
            <label for = "Name" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Name</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Name' id = 'NameID' placeholder = 'Name'>
            <label for = "Eligibility" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Adherent</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Email' id = 'EmailID' placeholder = 'Email@host.com'>
            <label for = "Eligibility" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Adherent</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = 'Password'>
            <label for = "Site" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control col-md-8 inline" name = "Site" id = "Site">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    echo "<option value = $id> $name</option>";
                }
            ?>
            </select>
            <label for = "Surname" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = 'N°'>
            <label for = "Surname" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Rue' id = 'Rue' placeholder = 'Rue'>
            <label for = "Surname" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>
            <label for = "Surname" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>
            <label for = "Eligibility" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Adherent</label>
            <select class="form-control col-md-8 inline" id = "Eligibility" name = "Eligibility">     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <p class = 'col-md-6 offset-md-3'><button class = "btn btn-success col-md-6 offset-md-3" id = "Inscription" type = "submit" value = "Inscription">Save changes</button></p>
        </div>
    </form> 
</div>

<?php
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';