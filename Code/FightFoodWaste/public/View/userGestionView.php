<?php
ob_start();

?>
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
            <th> <?= $user->getName(); ?></th>
            <th> <?= $user->getEmail(); ?></th>
            <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
            <th> <?= $user->getDiscriminator(); ?> </th>
            <th> <?= $user->getSite()->getName(); ?> </th>
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