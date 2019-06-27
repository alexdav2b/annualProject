<?php

require_once __DIR__ . '/../../Model/User.php';

if(isset($_SESSION['User'])){
    header('Location: 404');
}

$title = "FightFoodWaste - Login";
$script = "../js/connexionView.js";

ob_start();

?>
<div id = "connexionForm"  class = "formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2 style = "height : 8%">Connexion</h2>
    <form action = "/connexion" method = "post">
        <input class = "form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = "Email" id = "EmailID" placeholder = "Email">
        <input class = "form-control" type = "text" name = "Password" id = "PasswordID" placeholder = "Password">
        <!-- <p><a href = "#">Mot de passe oublié ?</a></p> -->
        <p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button type = "submit" class = "btn btn-success" id = "ConnexionID" type = "submit">Connexion</button></p>
    </form> 
</div>


<div id = "inscriptionForm" class = "container formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
<h2 style = "height : 5%">Inscription</h2>
    <div class = 'row form-group col-md-12' style = "height : 10%">
        
        <label for = "User" class = 'col-md-5 inline col-lg-5' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Are you ?</label>
        <select class="form-control col-md-7 inline col-lg-7" id = "User">
            <option value = "Individual" id = 'optionIndividual'>An Individual</option>
            <option value = "Saleman" id = 'optionSaleman'>A Saleman</option> 
        </select>
    </div>

    <form action = "/log/particulier" method = "post" id = 'Individual'> 
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <input required class = "form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = 'Surname'>
            <input required class = "form-control" type = "text" name = 'Name' id = 'NameID' placeholder = 'Name'>
            <input required class = "form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = 'Email' id = 'EmailID' placeholder = 'Email@host.com'>
            <input required class = "form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = 'Password'>
            <label for = "Site" class = 'col-lg-3 col-md-3 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control col-md-9 col-lg-9 inline" name = "Site" id = "Site">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    echo "<option selected value = $id> $name</option>";
                }
            ?>
            </select>
            <input required class = "form-control col-md-2 col-lg-2 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = 'N°'>
            <input required class = "form-control col-md-9 offset-md-1 col-lg-9 offset-lg-1 inline" type = "text" name = 'Rue' id = 'Rue' placeholder = 'Rue'>
            <input required class = 'form-control' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>
            <input required class = 'form-control' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>
            <p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button class = "btn btn-success" id = "Inscription" type = "submit" value = "Inscription">Sign In</button></p>
        </div>
    </form> 

    <form action = "/log/Saleman" method = "post" id = 'Saleman'> 
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <input required class = "form-control" type = "text" name = 'Siret' id = 'SiretID' placeholder = 'Siret'>
            <input required class = "form-control" type = "text" name = 'Name' id = 'NameID' placeholder = 'Name'>
            <input required class = "form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = 'Email' id = 'EmailID' placeholder = 'Email@host.com'>
            <input required class = "form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = 'Password'>
            <label for = "Site" class = 'col-md-3 col-lg-3 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control col-md-9 col-lg-9 inline" name = "Site" id = "Site">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    echo "<option selected value = $id> $name</option>";
                }
            ?>
            <input required class = "form-control col-md-2 col-lg-2 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = 'N°'>
            <input required class = "form-control col-md-9 offset-md-1 col-lg-9 offset-lg-1 inline" type = "text" name = 'Rue' id = 'Rue' placeholder = 'Rue'>
            <input required class = 'form-control' type = 'text' name = 'Postcode' id = 'Postcode' placeholder = 'Postcode'>
            <input required class = 'form-control' type = 'text' name = 'Area' id = 'Area' placeholder = 'Area'>
            <p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button class = "btn btn-success" id = "Inscription" type = "submit" value = "Inscription">Sign In</button></p>
        </div>
    </form>   
</div>

<?php

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>