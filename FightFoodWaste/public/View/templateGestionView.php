<?php

require_once __DIR__ . '/../Model/UserManager.php';
require_once __DIR__ . '/../Model/EmployeeManager.php';
require_once __DIR__ . '/../Model/IndividualManager.php';
require_once __DIR__ . '/../Model/SalemanManager.php';

require_once __DIR__ . '/../Model/TruckManager.php';


// $title = "Administration";
ob_start();
?>

<ul class="nav flex-column col-md-2" id = 'adminNav'>
    <li class="nav-item">
        <a class="nav-link active" href="#">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Adhesion</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Deliveries</a>
        <!-- Collecte & Distribution -->
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Stocks</a>
    </li>
</ul>

<div class = 'col-md-10 container-fluid'>
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
    <?= $gestionViewContent ?>
</div>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';
?>