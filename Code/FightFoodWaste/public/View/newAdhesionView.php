<?php
$title = 'Nouvelle Adhesion';

ob_start();

?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-md-6 offset-md-4 col-lg-6 offset-lg-4">Adhérer</h2>
    <p>Rejoignez-nous pour seulement 100€ par an</p>
    <form id = 'Adhesion' method = "post" action = "/adhesion">
        <div class = 'row form-group' style = 'margin-bottom : 0 !important; padding-top : 0 !important; padding-left : 15px !important; padding-right : 15px !important;'>
            
            <label for = "DateID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Date de début</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" type = "date" name = 'Date' id = 'DateID' placeholder = "" >

            <label for = "CBID" class = 'inline col-md-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Numero de Carte Bleue</label>
            <input required class = "inline col-md-8 col-lg-8 form-control" type = "text" name = 'CB' id = 'CB' placeholder = "CB">
 
            <label for = "NumeroID" class = 'inline col-md-4 col-lg-4' style = 'padding-top : 6px !important; padding-bottom : 6px !important;'>Code de sécurité</label>
            <input required class = "form-control col-md-8 inline" type = "text" name = 'Numero' id = 'NumeroID' placeholder = "Numero">

            <p class = 'col-md-12 col-lg-12 inline ' style = 'margin-top : 10em;'>
                <button type = "submit" class = "btn btn-success col-md-4 offset-md-1 col-lg-4 offset-lg-1" id = "Create">Enregistrer</button>
                <a href = "/adhesions/<?= $_SESSION['Id'] ?>" class = "btn btn-danger col-md-4 offset-md-2 col-lg-4 offset-lg-2" id = "Create">Annuler</a>
            </p>
        </div>
    </form>

</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';