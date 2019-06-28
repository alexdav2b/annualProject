<?php

$title = 'Itineraire';
$script = __DIR__ . "/../js/map.js";

ob_start();
?>
<div class = "col-md-6 offset-md-3 col-lg-6 offset-lg-3">
    <h2 class= "col-lg-6 offset-lg-4 col-md-6 offset-md-4">Itineraire</h2>
    <?= $s; ?>
    <hr>
    <?= $v; ?>
    <hr>
    <?= $c; ?>
    <hr>
    <?= $d; ?>
    <hr>
    <?= $depot; ?>

    <hr>
    Liste des articles pour cette collecte :
    <br>
    <br>nb articles tt : <?= $nbarticle ?><br>
    <br>
    <?php
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
    ?>
    
    <br>
    Nb d\'arrets : <?= $nbArret ?>
    <br><br>
    
    <?php
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

         print_r($order);
         echo '<br>';
         print_r($time);
        ?>
        <div id='map'>
        </div>
</div>
<?php 

$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';
?>