<?php

require_once __DIR__ . '/../Control/PointDePassage.php';
require_once __DIR__ . '/../Control/Tournee.php';

$point1 = new PointDePassage ('Natha', '3 Square Des Petits Bois', 91070, 'Bondoufle');
$point2 = new PointDePassage ('Test', '3 Square Des Petits Bois', 91070, 'Bondoufle');

echo $point1;
echo '<br>';echo '<br>';
echo $point2;

echo '<br>';

$tour = new Tournee ('14/02/2020');
//$tour->addPoint($point1);

echo $tour;

?>