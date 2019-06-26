<?php
ob_start();

?>
<div class = "row">
    <h2>User</h2>
    <a class = "btn btn-success" href = "/employe/new">Ajouter un Employé</a>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Adresse</th>
            <th>Status</th>
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