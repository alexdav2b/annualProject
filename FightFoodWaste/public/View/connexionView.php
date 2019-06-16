<?php

require_once __DIR__ . '/../../Model/User.php';
require_once __DIR__ . '/../../Control/Form.php';

$title = "Login";
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
                <option value = "Individual">An Individual</option>
                <option value = "Saleman">A Saleman</option> 
            </select>
        </div>
    <?php
    if(isset($user) && $user == 'Individual')
        require_once __DIR__ . 'inscriptionIndividualView.php'; 
    else if(isset($user) && $user == 'Saleman')
        require_once __DIR__ . 'inscriptionSalemanView.php'; 

    ?>
    
</div>
<?php

$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';

?>