<?php

require_once __DIR__ . '/../../Model/User.php';

if(isset($_SESSION['User'])){
    header('Location: 404');
}

$title = "FightFoodWaste - Login";
$scripts = array();
array_push($scripts, "../js/connexionView.js");

ob_start();

?>
<div id = "connexionForm"  class = "formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2 style = "height : 8%">Connexion</h2>
    <form action = "/connexion" method = "post" onsubmit = 'Connexion(this)'>
        <input onblur ='verifEmail(this)' class = "form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = "Email" id = "EmailID" placeholder = "Email">
        <input onblur = 'verifMdp(this)' class = "form-control" type = "text" name = "Password" id = "PasswordID" placeholder = "Password">
        <!-- <p><a href = "/mdp">Mot de passe oublié ?</a></p> -->
        <p class = 'col-md-6 offset-md-3 col-lg-6 offset-lg-3'><button type = "submit" class = "btn btn-success" id = "ConnexionID" type = "submit">Connexion</button></p>
    </form> 
</div>

<div id = "inscriptionForm" class = "container formulaire col-xs-3 col-sm-3 col-md-3 col-lg-3 offset-xs-2 offset-sm-2 offset-md-2 offset-lg-2">
    <h2 style = "height : 5%">Inscription</h2>
    <div class = 'row form-group  container' >
        <div class = 'row form-group col-md-12' style = "height : 10%; margin-bottom : 0px;margin-top : 0px;"  >

        <label for = "User" class = 'col-md-5 inline col-lg-5' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Are you ?</label>
        <select onchange = 'Chose()' class="form-control col-md-7 inline col-lg-7" id = "User">
            <option value = "null">--Choisir--</option>
            <option value = "Individual" id = 'optionIndividual'>Particulier</option>
            <option value = "Saleman" id = 'optionSaleman'>Magasin</option> 
        </select>
            </div>
        </div>
        
        <form class = 'row form-group container' id = "Choisir"> 
        <div class = 'row form-group col-md-12' style = "height : 10%; margin-bottom : 0px;margin-top : 0px;" >
            <label for = 'Site' class = 'col-md-3 col-lg-3 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class='form-control col-md-9 col-lg-9 inline' name = 'Site' id = 'Site'>
            <!-- <option selected >--Choisir--</option> -->
            <?php
            foreach($sites as $site){
                $name = $site->getName();
                $id = $site->getId();
                echo "<option value = $id> $name</option>";
            }
            ?>
            </select>
        </div>
        <div class = 'row form-group col-md-12' style = "height : 10%; margin-bottom : 0px;margin-top : 0px;" id = "div-in" >

        </div>
        </form>
        
    </div>
</div>

<?php

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>