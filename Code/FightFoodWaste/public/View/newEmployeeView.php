<?php
$title = 'Nouvel Employé';
$scripts = array(); 
ob_start();

?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-md-6 offset-md-4 col-lg-6 offset-lg-4">Nouvel Employé</h2>

    <form id = 'Employee' method = "post" action = "/log/employe">
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            
            <label for = "SurnameID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>First name</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Surname' id = 'SurnameID' placeholder = "First name">

            <label for = "NameID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Name</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Name' id = 'NameID' placeholder = "Name">

            <label for = "EmailID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Email</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type = "email" name = 'Email' id = 'EmailID' placeholder = "Email@host.fr">

            <label for = "PasswordID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Password</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'Password' id = 'PasswordID' placeholder = "Password">
 
            <label for = "SiteID" class = 'col-md-4 inline col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Site</label>
            <select class="form-control inline col-md-8 col-lg-8 inline" name = "Site" id = "SiteID">
            <?php
                foreach($sites as $site){
                    $name = $site->getName();
                    $id = $site->getId();
                    echo "<option value = $id> $name</option>";
                }
            ?>
            </select>
            <label for = "NumeroID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Numero</label>
            <input required class = "form-control col-md-8 col-lg-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = "Numero">

            <label for = "RueID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Rue</label>
            <input required class = "form-control col-md-8 col-lg-8 inline" type = "text" name = 'Rue' id = 'RueID' placeholder = "Rue">

            <label for = "PostcodeID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Postcode</label>
            <input required class = 'form-control col-md-8 col-lg-8 inline' type = 'text' name = 'Postcode' id = 'PostcodeID' placeholder = "Postcode">

            <label for = "AreaID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Area</label>
            <input class = 'form-control col-md-8 col-lg-8 inline' type = 'text' name = 'Area' id = 'AreaID' placeholder = "Area">

            <label for = "SalaryID" class = 'col-md-4 inline col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Salary</label>
            <input required type="number" step = "0.01" class="form-control col-md-8 col-lg-8 inline" id = "SalaryID" name = "Salary" placeholder = "Salaire">     

            <p class = 'col-md-12 inline '>
                <button type = "submit" class = "btn btn-success col-lg-4 offset-lg-1 col-md-4 offset-md-1" id = "Create">Enregistrer</button>
                <a href = "/comptes" class = "btn btn-danger col-lg-4 offset-lg-2 col-md-4 offset-md-2" id = "Create">Annuler</a>
            </p>
        </div>
    </form>

</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';