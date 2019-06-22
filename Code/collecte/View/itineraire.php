<?php

$url = 'http://apipa/';

require_once __DIR__ . '/../Model/Adresse.php';
require_once __DIR__ . '/../Model/Vehicule.php';
require_once __DIR__ . '/../Model/Conducteur.php';
require_once __DIR__ . '/../Model/Article.php';
require_once __DIR__ . '/../Model/Site.php';
require_once __DIR__ . '/../Model/Depot.php';
require_once __DIR__ . '/../Model/Arret.php';

$json_site = file_get_contents($url.'site/'.$_POST['site']);
$site_data = json_decode($json_site);

$s = new Site($site_data->ID, $site_data->Name);
echo $s;

echo "<hr>";

$json_truck = file_get_contents($url.'/truck');
$truck_data = json_decode($json_truck);

$truck = getTruckByIdSite($truck_data, $s->getId());

//Aller le chercher en bdd
$v = new Vehicule($truck->ID, $truck->Plate, $truck->Name, $truck->Capacity);
echo $v;

echo "<hr>";

$json_usr = file_get_contents($url.'/usr');
$usr_data = json_decode($json_usr);

$usr = getConducteurBySite($usr_data,  $s->getId());
//print_r($usr);

//recherche en bdd des salarié qui sont chauffeur et du site choisi
$c = new Conducteur ($usr->ID, $usr->Surname, $usr->Name, $usr->Email );
echo $c;

echo "<hr>";

//choix du salarié
$d = $_POST['date'];
echo $d;

echo "<hr>";

$json_depot = file_get_contents($url.'/depositery');
$depot_data = json_decode($json_depot);

$depot_temp = findDepot($depot_data, $s->getId());
//print_r($depot_temp);

//en fonction du site, trouvé le dépot en bddd, instancier de dépot
$depot = new Depot ($depot_temp->ID, $depot_temp->Numero, $depot_temp->Rue, $depot_temp->Postcode, $depot_temp->Area, $depot_temp->Capacity);
echo $depot;

echo "<hr>";

echo "Test de création d'un arrêt : <br><br>";

$a = new Arret ('To', '3', 'Square des Petits Bois', '91070', 'Bondoufle', 5);
echo $a;

echo "<hr>";

//select du nb d'articles dont le statut = 2, qui ont pour DeliveryID = $depot.ID


$json_product = file_get_contents($url.'/product');
$product_data = json_decode($json_product);

$index = findArticleDonne($product_data, $depot->getID());

$nbarticle = count($index);

echo '<br>nb articles tt : '.$nbarticle;
echo '<br>';

$articles = [];

$tabIdDonnateur = [];
$nbArret = 0;

for($i = 0 ; $i<$nbarticle ; $i++){
    //print_r($product_data[$index[$i]]);
    $articles[$i] = new Article ( $product_data[$index[$i]]->ID, $product_data[$index[$i]]->Name, $product_data[$index[$i]]->Barcode, $product_data[$index[$i]]->UsrID_Donated );
    echo $articles[$i];
    if( !in_array($articles[$i]->getIdUsrDonated(), $tabIdDonnateur) ){
        $tabIdDonnateur[$nbArret] = $articles[$i]->getIdUsrDonated();
        $nbArret++;
    }
    echo '<br>';
}

//print_r($tabIdDonnateur);
echo '<br>';
echo 'Nb d\'arrets : '.$nbArret;
echo '<br><br>';
$arrets = []; 

for($i=0 ; $i<$nbArret ; $i++){
    $json_donnateur = file_get_contents($url.'usr/'.$tabIdDonnateur[$i]);
    $donnateur = json_decode($json_donnateur);
    $arrets[$i] = new Arret ($donnateur->Surname, $donnateur->Numero, $donnateur->Rue, $donnateur->Postcode, $donnateur->Area );
    echo $arrets[$i];
    echo '<br><br>';
}

function getTruckByIdSite($data_truck, $id){
    foreach($data_truck as $truck){
        if($truck->SiteID == $id){
            return $truck;
        }
    }
    return null;
}

function getConducteurBySite($data_usr, $id){
    foreach($data_usr as $usr){
        if($usr->Discriminator == "Employer" and $usr->SiteID == $id){
            return $usr;
        }
    }
    return null;
}

function findDepot($data_depot, $id){
    foreach($data_depot as $depot){
        if($depot->SiteID == $id){
            return $depot;
        }
    }
    return null;
}

function findArticleDonne($data_product, $id){
    $i = 0;
    $index = [];
    $nb = 0;
    foreach($data_product as $product){
        if($product->DepositeryID == $id and $product->StatutID == 2){
            $index[$nb] = $i;
            $nb++;
        }
        $i++;
    }
    return $index;
}


?>
