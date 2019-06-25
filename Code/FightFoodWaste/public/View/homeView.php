<?php
$title = 'FightFoodWaste';

ob_start();

// $userType = $_SESSION['User']; 

?>
<img src = '../images/fond1.jpg' style ="width : 100%">

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';