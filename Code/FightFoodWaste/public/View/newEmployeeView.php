<?php
$title = 'Votre compte';
$script = "../js/userView.js";

ob_start();

$userType = 'Admin'; 

$url = "/particulier/update/" . $user->getId();

?>
<div class = "col-md-6 offset-md-3">
    <h2 class= "col-md-6 offset-md-4">Votre Compte</h2>

    <form id = 'Employee' method = "post" action = "/log/employe">
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            
            <label for = "SurnameID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>First name</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = <?= $user->getSurname() ?>>

            <label for = "NameID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Name</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Name' id = 'NameID' placeholder = <?= $user->getName() ?>>

            <label for = "EmailID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Email</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Email' id = 'EmailID' placeholder = <?= $user->getEmail() ?>>

            <label for = "PasswordID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Password</label>
            <input class = "inline col-md-8 form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = <?= $user->getPassword() ?>>
 
            <label for = "SiteID" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control inline col-md-8 inline" name = "Site" id = "SiteID">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    echo "<option value = $id> $name</option>";
                }
            ?>
            </select>
            <label for = "NumeroID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Numero</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = <?= $user->getNumero() ?>>

            <label for = "RueID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Rue</label>
            <input class = "form-control col-md-8 inline" type = "text" name = 'Rue' id = 'RueID' placeholder = <?= $user->getRue() ?>>

            <label for = "PostcodeID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Postcode</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Postcode' id = 'PostcodeID' placeholder = <?= $user->getPostcode() ?>>

            <label for = "AreaID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Area</label>
            <input class = 'form-control col-md-8 inline' type = 'text' name = 'Area' id = 'AreaID' placeholder = <?= $user->getArea() ?>>

            <label for = "SalaryID" class = 'col-md-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Salary</label>
            <select class="form-control col-md-8 inline" id = "SalaryID" name = "Salary">     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>

        </div>
    </form>
    <p class = 'col-md-12 inline '>
        <button class = "btn btn-success col-md-4 offset-md-1" id = "Create">Enregistrer</button>
    </p>
</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';