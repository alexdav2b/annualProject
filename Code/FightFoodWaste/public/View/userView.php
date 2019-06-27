<?php
$title = 'Votre compte';
$script = "../js/userView.js";

$userType = $_SESSION['User'];
ob_start();

?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Votre Compte</h2>

    <form id = 'User' method = "post" action = "<?= $url ?>" >
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            
            <?php if ($userType == 'Individual' || $userType == 'Employer' || $userType == 'Admin' || $userType == 'Volunteer'){ ?>
            <label for = "SurnameID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Surname</label>
            <input class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = <?= $user->getSurname() ?>>
            <p id = 'Surname' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getSurname() ?></p>
            <?php } ?>

            <?php if ($userType == 'Saleman'){ ?>
            <label for = "SiretID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Siret</label>
            <input class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Siret' id = 'SiretID' placeholder = <?= $user->getSiret() ?>>
            <p id = 'Siret' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getSiret() ?></p>
            <?php } ?>

            <label for = "NameID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Name</label>
            <input class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Name' id = 'NameID' placeholder = <?= $user->getName() ?>>
            <p id = 'Name' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getName() ?></p>

            <label for = "EmailID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Email</label>
            <input class = "inline col-md-8 col-lg-8 form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = 'Email' id = 'EmailID' placeholder = <?= $user->getEmail() ?>>
            <p id = 'Email' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getEmail() ?></p>

            <label for = "PasswordID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Password</label>
            <input type="password" class = "inline col-md-8 col-lg-8 form-control" name = 'Password' id = 'PasswordID' placeholder = "*****">
            <p id = 'Password' class ="plaintext inline col-md-8 col-lg-8 form-control">*****</p>
            <p id = 'PasswordHide' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getPassword(); ?></p>

            <label for = "SiteID" class = 'col-md-4 col-lg-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control inline col-md-8 col-lg-8 inline" name = "Site" id = "SiteID">
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
            <p id = 'Site' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getSite()->getName() ?></p>

            <label for = "NumeroID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Numero</label>
            <input class = "form-control col-md-8 col-lg-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = <?= $user->getNumero() ?>>
            <p id = 'Numero' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getNumero() ?></p>

            <label for = "RueID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Rue</label>
            <input class = "form-control col-md-8 col-lg-8 inline" type = "text" name = 'Rue' id = 'RueID' placeholder = <?= $user->getRue() ?>>
            <p id = 'Rue' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getRue() ?></p>

            <label for = "PostcodeID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Postcode</label>
            <input class = 'form-control col-md-8 col-lg-8 inline' type = 'text' name = 'Postcode' id = 'PostcodeID' placeholder = <?= $user->getPostcode() ?>>
            <p id = 'Postcode' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getPostcode() ?></p>

            <label for = "AreaID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Area</label>
            <input class = 'form-control col-md-8 col-lg-8 inline' type = 'text' name = 'Area' id = 'AreaID' placeholder = <?= $user->getArea() ?>>
            <p id = 'Area' class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getArea() ?></p>

            <?php if($userType == 'Employer') { ?>
            <label for = "SalaryID" class = 'col-md-4 col-lg-4 inline' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Salary</label>
            <select class="form-control col-md-8 col-lg-8 inline" id = "SalaryID" name = "Salary" placeholder = <?= $user->getSalary() ?>>     
                <option value = "Yes">Yes</option>
                <option value = "No">No</option>
            </select>
            <p id = "Salary" class ="plaintext inline col-md-8 col-lg-8 form-control"><?= $user->getSalary() ?>€</p>
            <?php } ?>

        </div>
    </form>
    <p class = 'col-md-12 inline '>
        <a href = "/compte/delete/<?= $user->getId(); ?>" class = "btn btn-danger col-lg-4 offset-lg-1 col-md-4 offset-md-1" id = "Delete" >Supprimer</a>
        <button class = "btn btn-success col-lg-4 offset-lg-1 col-md-4 offset-md-1" id = "Update">Enregistrer</button>
        <button class = "btn btn-outline-success col-lg-4 offset-lg-2 col-md-4 offset-md-2" id = "Modify">Modifier</button>
        <button class = "btn btn-outline-danger col-lg-4 offset-lg-2 col-md-4 offset-md-2" id = "Abort" >Annuler</button>
    </p>

</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';