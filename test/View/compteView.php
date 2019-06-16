<?php

require_once __DIR__ . '/../Model/UserManager.php';

$title = "Votre Compte";
ob_start(); ?>

<table class = "table table-hover table-responsive table-striped col-md-12">

<?php

$userManager = new UserManager();

$userManager->gestionViewOne(4);

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/gestionView.php'; ?>

</table> 

<button type="button" class = "btn btn-outline-success" style = 'margin : 12px'><a href = 'compteUpdateView.php'>Modifier</a></button>
<button type="button" class = "btn btn-outline-danger">Supprimer</button>



