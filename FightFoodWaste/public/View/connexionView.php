<?php

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Control/Form.php';

$title = "FightFoodWaste - Login";
$script = "../js/connexionView.js";

ob_start();

?>
<div id = "connexionForm" class = "formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2>Connexion</h2>
    <?php $connexion = new Form(array('Email', 'Password')); ?>
    <form action = '../Control/Connexion.php' method = "post">
        <!-- <?php echo $connexion->input('Email'); ?>
        <input class = "form-control" type = "password" name = "Password" id = "Password" placeholder = "Password">; -->
        <?php $connexion->echoAllInputs(); ?>
        <p><a href = "#">Mot de passe oublié ?</a></p>
        <?php  echo $connexion->submit('Connexion'); ?>
    </form> 
</div>


<div id = "inscriptionForm" class = "formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2 class= 'inline'>Inscription</h2>
    <div class = 'row form-group col-md-12' >
        <label for = "User" class = 'col-md-5 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Are you ?</label>
        <select class="form-control col-md-7 inline" id = "User">
            <option value = "Individual" id = 'optionIndividual'>An Individual</option>
            <option value = "Saleman" id = 'optionSaleman'>A Saleman</option> 
        </select>
    </div>

    <form action = "OnInscription()" method = "post" id = 'Individual'> 
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

    <form action = "OnInscription()" method = "post" id = 'Saleman'> 
        <div class = 'row form-group col-md-12' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <input class = "form-control" type = "text" name = 'Siret' id = 'SiretID' placeholder = 'Siret'>
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
</div>
<?php

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>