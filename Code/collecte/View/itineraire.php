<?php

$url = 'http://apipa/';

require_once __DIR__ . '/../Model/Adresse.php';
require_once __DIR__ . '/../Model/Vehicule.php';
require_once __DIR__ . '/../Model/Conducteur.php';
require_once __DIR__ . '/../Model/Article.php';
require_once __DIR__ . '/../Model/Sitee.php';
require_once __DIR__ . '/../Model/Depot.php';
require_once __DIR__ . '/../Model/Arret.php';
require_once __DIR__ . '/../Model/GmapApi.php';

$json_site = file_get_contents($url.'site/'.$_POST['site']);
$site_data = json_decode($json_site);

$s = new Sitee($site_data->ID, $site_data->Name);
echo $s;

echo "<hr>";

$json_truck = file_get_contents($url.'/truck');
$truck_data = json_decode($json_truck);

$truck = getTruckByIdSite($truck_data, $s->getId());

//Aller le chercher en bdd
$v = new Vehicule($truck->ID, $truck->Plate, $truck->Name, $truck->Capacity);
echo $v;

echo "<hr>";

//recherche en bdd de tous les user
$json_usr = file_get_contents($url.'/usr');
$usr_data = json_decode($json_usr);

//fonction qui recherche un salarié
$usr = getConducteurBySite($usr_data,  $s->getId());

//construction d'un salarié
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

//select du nb d'articles dont le statut = 2, qui ont pour DeliveryID = $depot.ID


$json_product = file_get_contents($url.'/product');
$product_data = json_decode($json_product);

$index = findArticleDonne($product_data, $depot->getID());

$nbarticle = count($index);

echo 'Liste des articles pour cette collecte : <br>';
echo '<br>nb articles tt : '.$nbarticle.'<br>';
echo '<br>';

$articles = [];

$tabIdDonnateur = [];
$nbArret = 0;

for($i = 0 ; $i<$nbarticle ; $i++){
    //print_r($product_data[$index[$i]]);
    $articles[$i] = new Article ( $product_data[$index[$i]]->ID, $product_data[$index[$i]]->Name, $product_data[$index[$i]]->Barcode, $product_data[$index[$i]]->UsrID_Donated );
    //affichage des articles
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
$temp = 0;
for($i=0 ; $i<$nbArret ; $i++){
    $json_donnateur = file_get_contents($url.'usr/'.$tabIdDonnateur[$i]);
    $donnateur = json_decode($json_donnateur);
    $temp = 0;
    for($j = 0 ; $j<$nbarticle ; $j++){
        if( $articles[$j]->getIdUsrDonated() ==  $tabIdDonnateur[$i] ){
            $temp++ ;
        }
    }

    $arrets[$i] = new Arret ($donnateur->Surname, $donnateur->Numero, $donnateur->Rue, $donnateur->Postcode, $donnateur->Area , $temp);
    echo $arrets[$i];
    echo '<br><br>';
}

//récupération dans un tableau les coordonnés des endroit où aller
$coordonnee = array();
$adDep = ''.$depot->getNumero().' '.$depot->getRue().' '.$depot->getCode().' '.$depot->getVille();
echo '<br>'.$adDep.'<br>';

$data = GmapApi::geocodeAddress($adDep);
echo '<ul>';
foreach ($data as $key=>$value){
    echo '<li>'.$key.' : '.$value.'</li>';
}
echo '</ul><br>';


for($i = 0 ; $i<$nbArret ; $i++){
    $ad = ''.$arrets[$i]->getNumero().' '.$arrets[$i]->getRue().' '.$arrets[$i]->getCodePostale().' '.$arrets[$i]->getVille();
    
    echo $ad;
    echo '<br>';

    $data = GmapApi::geocodeAddress($ad);
    echo '<ul>';
    foreach ($data as $key=>$value){
        echo '<li>'.$key.' : '.$value.'</li>';
    }
    echo '</ul>';
}

$itineraiUrl = "https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA";

$point_json = file_get_contents($itineraiUrl);
$data_itineraire = json_decode($point_json);

$order = findOrder($data_itineraire, $nbArret);
print_r($order);
echo '<br>';

$time = findTime($data_itineraire, $nbArret);
print_r($time);








/*

https://api.mapbox.com/optimized-trips/v1/mapbox/driving/2.3687413,48.6101204;2.5475181,48.6138689;2.4278819,48.6304044?access_token=pk.eyJ1IjoibmF0aGFzZW5zZWkiLCJhIjoiY2p3cWM3czRlMDFpbDQ1cDZpb2d4ZnY0NyJ9.tWZI8jmVY33ao20AauBnWA

*/

//fonction pour trouver les temps de trajet entre chaque point
function findTime($data_itineraire, $nb){
    $time = array();
    $i = 0;

    for($i=0; $i <= $nb ; $i++){
        $time[$i] = $data_itineraire->trips[0]->legs[$i]->duration;
    }
    return $time;
}

//Creation de l'url pour faire l'itinéraire 
function createUrlApi(){

}

//fonction pour trouver l'order des endroit où aller
function findOrder($data_itineraire, $nb){
    $order = array();
    $i = 0;

    for($i=0; $i <= $nb ; $i++){
        $order[$i] = $data_itineraire->waypoints[$i]->waypoint_index;
    }
    return $order;
}


//fonction pour sélection un véhicule en fonction du site choisi
function getTruckByIdSite($data_truck, $id){
    foreach($data_truck as $truck){
        if($truck->SiteID == $id){
            return $truck;
        }
    }
    return null;
}

//fonction pour sélection une chauffeur (salarié) en fonction du site choisi
function getConducteurBySite($data_usr, $id){
    foreach($data_usr as $usr){
        if($usr->Discriminator == "Employer" and $usr->SiteID == $id){
            return $usr;
        }
    }
    return null;
}

//fonction pour trouver le dépot en fonction du site choisie
function findDepot($data_depot, $id){
    foreach($data_depot as $depot){
        if($depot->SiteID == $id){
            return $depot;
        }
    }
    return null;
}

//fonction pour trouvé les articles donné qui n'nont pas encore été récupérés
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

function findItineraire($data_itineraire, $nbArret){
    
    $point = array();

    for($i=0; $i<$nbArret ; $i++){
        for($j=0 ; $j<$nbArret ; $j++){

        }
    }
}

?>
