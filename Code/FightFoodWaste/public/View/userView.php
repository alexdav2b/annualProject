<?php
$title = 'Votre compte';
$script = "../js/userView.js";
//action = "/log/Individual" method = "put"
ob_start();
?>
<div class = "col-md-6 offset-md-3">
    <h2 class= "col-md-6 offset-md-4">Votre Compte</h2>
    <form   id = 'Individual' >
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            <label for = "SurnameID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Firstname</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = <?= $user->getSurname() ?>>
            <p id = 'Surname' class ="plaintext inline col-md-8 form-control"><?= $user->getSurname() ?></p>

            <label for = "NameID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Name</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Name' id = 'NameID' placeholder = <?= $user->getSurname() ?>>
            <p id = 'Name' class ="plaintext inline col-md-8 form-control"><?= $user->getName() ?></p>

            <label for = "EmailID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Email</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Email' id = 'EmailID' placeholder = <?= $user->getEmail() ?>>
            <p id = 'Email' class ="plaintext inline col-md-8 form-control"><?= $user->getEmail() ?></p>

            <label for = "PasswordID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Password</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = <?= $user->getPassword() ?>>
            <p id = 'Password' class ="plaintext inline col-md-8 form-control"><?= $user->getPassword() ?></p>

            <label for = "SiteID" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control inline col-md-8 inline" name = "Site" id = "SiteID">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    if($user->getSite() == $site){
                        echo "<option id = 'Site' selected value = $id> $name</option>";
                    }else{
                        echo "<option value = $id> $name</option>";
                    }
                }
            ?>
            </select>
            <p id = 'Site' class ="plaintext inline col-md-8 form-control"><?= $user->getSite()->getName() ?></p>

            <label for = "NumeroID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Numero</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = <?= $user->getNumero() ?>>
            <p id = 'Numero' class ="plaintext inline col-md-8 form-control"><?= $user->getNumero() ?></p>

            <label for = "RueID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Rue</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Rue' id = 'RueID' placeholder = <?= $user->getRue() ?>>
            <p id = 'Rue' class ="plaintext inline col-md-8 form-control"><?= $user->getRue() ?></p>

            <label for = "PostcodeID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Postcode</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Postcode' id = 'PostcodeID' placeholder = <?= $user->getPostcode() ?>>
            <p id = 'Postcode' class ="plaintext inline col-md-8 form-control"><?= $user->getPostcode() ?></p>

            <label for = "AreaID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Area</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Area' id = 'AreaID' placeholder = <?= $user->getArea() ?>>
            <p id = 'Area' class ="plaintext inline col-md-8 form-control"><?= $user->getArea() ?></p>

            <label for = "EligibilityID" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Adherent</label>
            <select class="form-control col-md-8 inline" id = "EligibilityID" name = "Eligibility">     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <p id = "Eligibility" class ="plaintext inline col-md-8 form-control"><?= $user->getEligibility()?></p>

        </div>
    </form>
    <p class = 'col-md-6 offset-md-3'><button class = "btn btn-success col-md-6 offset-md-3" id = "Update"value = "Inscription">Save changes</button></p>

    <p class = 'col-md-6 offset-md-3'><button class = "btn btn-success col-md-6 offset-md-3" id = "Modify" value = "Inscription">Modify</button></p>
</div>

<?php //  type = "submit" 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';