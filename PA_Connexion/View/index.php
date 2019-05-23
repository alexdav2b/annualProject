<?php
require_once __DIR__ . '/../Control/User/User.php';
$title = "Fight Food Waste";

ob_start();

$u1 = new User(1, 'soso94169@hotmail.fr', 'sophie', 'pelluet', 'lampe', '94 Chaus�e de l Etang 94160 Stmand�', 1);
echo $u1;

$content = ob_get_clean();



require_once __DIR__ . '/templateView.php';


?>