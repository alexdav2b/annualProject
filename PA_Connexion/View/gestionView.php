<?php
require_once __DIR__ . '/../Control/User/User.php';

$title = "Connexion";
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
            <option>Users</option>
            <option>Eligible</option>
            <option>Workers</option>
            <option>Gvers</option>
        </select>
        
        <!-- Workers -->
        <select class="form-control col-md-4 offset-md-1" >
            <option>Employees</option>
            <option>Volunteers</option>
        </select>

        <!-- Eligible -->
        <!-- <select class="form-control col-md-4" >
            <option>Users</option>
            <option>Members</option>
            <option>ONGs</option>
        </select> -->

        <!-- Givers -->
        <!-- <select class="form-control col-md-4" >
            <option>Members</option>
            <option>Stores</option>
        </select> -->
        <button class = "btn btn-success col-md-1 offset-md-1">Go</button>
    </form>
    <table class="table table-hover table-responsive table-striped col-md-12">
        <thead>
            <tr>
                <th>Username</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Password</th>
                <th>Address</th>
                <th>Eligibility</th>
                <th>Company</th>
                <th>SIRET</th>
                <th>Discriminator</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
require_once __DIR__ . '/templateView.php';
?>