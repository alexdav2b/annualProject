<?php

$title = "FightFoodWaste - Administration";
ob_start();
?>

<ul class="nav flex-column col-lg-2 col-md-2" id = 'adminNav' style="padding-top : 1em">
    <li class="nav-item">
        <a class="nav-link active" href="/comptes" style = "color : white">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/adhesions" style = "color : white">Adhesion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" style = "color : white">Deliveries</a>
        <!-- Collecte & Distribution -->
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#" style = "color : white">Stocks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/employe/new" style = "color : white">+ Nouvel Employé</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/admin/new" style = "color : white">+ Nouvel Admin</a>
    </li>   
</ul>
<div class = 'col-md-10 container-fluid'>
    <!-- <?php if(isset($boolDivFilter)) { ?>
    <h2>Users</h2>
    <form class = 'form-group col-md-12 row'>
        <select class="form-control col-md-4 " >
            <option>All</option>
            <option>Employees</option>
            <option>Volunteers</option>
            <option>Companies</option>
        </select>
        <button class = "btn btn-success col-md-1 offset-md-1">Go</button>
    </form>
    <?php } ?> -->
    <?= $gestionViewContent ?>
</div>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';
?>