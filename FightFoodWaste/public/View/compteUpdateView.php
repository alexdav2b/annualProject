<?php

require_once __DIR__ . '/../Model/UserManager.php';

$title = "Modification du compte";
ob_start(); 

$userManager = new UserManager();
$user = $userManager->getById(4);

?>
<form>
    <input type = 'text' name = "name"><br> 

</form>
<table class = "table table-hover table-responsive table-striped col-md-12">

<?php

$gestionViewContent = ob_get_clean();
require_once __DIR__ . '/gestionView.php'; ?>

</table>   
