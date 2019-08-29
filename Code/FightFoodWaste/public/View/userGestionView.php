<?php
$title = 'Gestion utilisateurs';
$scripts = array(); 
array_push($scripts,"../js/userGestion.js");

ob_start();
?>
<script>
function SearchUser() {
    searchCont = document.getElementById("searchCont").value;
    var SSC = String(searchCont);
    selectRow = document.getElementById("selectRow").selectedIndex
    users = document.getElementsByTagName("tr");
    for(var i = 0; i < users.length; i++)
    {
        var matchRow = users[i].getElementsByTagName("th");
        var match = matchRow[selectRow - 1].innerHTML;
        var Smatch = String(match).trim();  
        
        if(Smatch.valueOf() == SSC.valueOf())
        {
            console.log("fouuuuuuuuund ", Smatch);
        }
        else{
            console.log("remove : " + match);
            users[i].parentNode.removeChild(users[i]);
            i--;
        }
    }
    
}</script>


<div id='' class='col-md-12 col-lg-12 row'>
<label for="date" class="inline col-md-2 col-lg-2" style="padding-top : 6px !important; padding-bottom : 6px !important;">Recherche :</label>
    <select id="selectRow" class="form-control inline col-md-2 col-lg-2 inline" id="siteId" name="site">
                <option>--Choisir--</option>
                <option value="1"> Nom </option>
                <option value="2"> Email </option>
                <option value="3"> Adresse </option>
                <option value="4"> Statut </option>
                <option value="5"> Site </option>
    </select>
    <input type='text' id="searchCont" class="col-md-3 col-lg-3 col inline" style="padding-top : 6px !important; padding-bottom : 6px !important";>
    <button id='' onclick='SearchUser()' class='btn btn-success col-md-2 col-lg-2 inline'>Rechercher</button>
    <button id='' onclick='location.reload()' class='btn btn-danger col-md-2 col-lg-2 inline'>Annuler</button>
    
</div>
<div class = "row">
    <h2 class="offset-md-1">Utilisateurs</h2>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Statut</th>
            <th>Site</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(isset($users)){
        foreach ($users as $user){
            $site = $user->getSite();
            ?>
        <tr>
            <th name='1'> <?= $user->getName(); ?></th>
            <th name='2'> <?= $user->getEmail(); ?></th>
            <th name='3'> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
            <th name='4'> <?= $user->getDiscriminator(); ?> </th>
            <th name='5'> <?= $user->getSite()->getName(); ?> </th>
        </tr>
    <?php }
    }else{ 
        $site = $user->getSite(); ?>
        <tr>
            <th> <?= $user->getName(); ?></th>
            <th> <?= $user->getEmail(); ?></th>
            <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
            <th> <?= $user->getDiscriminator(); ?> </th>
            <th> <?= $user->getSite()->getName(); ?> </th>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php

$gestionViewContent = ob_get_clean();

require_once __DIR__ . '/templateGestionView.php';
?>