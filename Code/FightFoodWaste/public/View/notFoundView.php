<?php

$title = 'Error 404 - Page not found';

ob_start();
?>

<div class = "col-md-6 offset-md-3">
    <img src = '../images/404-not-found.png' style ="width : 100%">
    <p class = 'col-md-12 inline '>
        <a href = "/" class = "btn btn-success col-md-4 offset-md-4" id = "Home">Home</a>
        <!-- <a href = "javascript:history.go(-1)>" class = "btn btn-danger  col-md-4" id = "Back" >Back</a> -->
    </p>
</div>

<?php 
$content = ob_get_clean();

require_once __DIR__ . '/templateView.php';