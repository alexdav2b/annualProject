<?php
ob_start();

$user = $this->getById($id);
if($user != NULL){
?>
<thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Adresse</th>
        <th>Eligibility</th>
        <th>Site</th>
    </tr>
</thead>
<tbody>
    <tr>
        <th> <?= $user->getName(); ?></th>
        <th> <?= $user->getEmail(); ?></th>
        <th> <?= $user->getNumero() . ', ' .  $user->getRue() . ' ' . $user->getPostcode() . ' ' . $user->getArea() ?> </th>
        <th> <?= $user->getEligibility(); ?></th>
        <th> <?= $user->getSite()->getName(); ?> </th>
    </tr>
</tbody>
<?php
}

$gestionViewContent = ob_get_clean();

require_once __DIR__ . '/templateGestionView.php';