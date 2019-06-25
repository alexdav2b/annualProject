<?php

    if(isset($_SESSION['User']) && isset($_SESSION['Id']) && $_SESSION['User'] != null && $_SESSION['Id'] != null){
        $bool = true;
        $url = '/';
        switch($_SESSION['User']){
            case 'Individual' :
                $url .= 'particulier/';
                break;
            case 'Saleman' :
                $url .= 'commercant/';
                break;
            case 'Admin':
                $url .= 'admin/';
                break;
            case 'Employer' :
                $url .= 'employe/';
                break;
        }
        $url .= $_SESSION['Id'];
    }else{
        $url = false;
        $bool = false;
    }
?>

<header class = "navbar navbar-expand-sm">
    <ul class = "navbar-nav align-items-center">
        <li class = "nav-item col-md-3 offset-md-1">
            <a href = "/about" style = 'text-transform : uppercase' class = 'nav-link'>
                <h5 class = 'menu'>A propos</h5>
            </a>
        </li>
        <li class="nav-item col-md-2">
            <a href = "/comptes" style = 'text-transform : uppercase' class= 'nav-link'>
                <h5 class = 'menu'>Admin</h5>
            </a>
        </li>
        <a href = "/" class = 'navbar-brand nav-item col-md-1'>
            <img src = '../images/logo.png' style="width:40px;">
        </a>
        <li class = 'nav-item col-md-4'>
            <a href = '/' class = 'nav-link' id = 'titre'>
                <h1>FightFoodWaste</h1>
            </a>
        </li>
        <!-- Dropdown -->
        <?php if($bool){ ?>
        <li class="nav-item dropdown col-md-3">
            <a class = "nav-link dropdown-toggle menu menuDropDown" href = "#" id = "navbardrop" data-toggle = "dropdown">
                Compte
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item itemDropdown" href = "#" style = 'text-transform : uppercase'>
                    <h6>Voir</h6>
                </a>
                <a class="dropdown-item itemDropdown" href = "#" style = 'text-transform : uppercase'>
                    <h6>Adhesion</h6>
                </a>
                <a class="dropdown-item itemDropdown" href = "#" style = 'text-transform : uppercase'>
                    <h6>Deliveries</h6>
                </a>
            </div>
        </li>
        <li class="nav-item col-md-3">
            <a href = "/deconnexion" style = 'text-transform : uppercase' class= 'nav-link'>
                <h5 class = 'menu'>Déconnexion</h5>
            </a>
        </li>
        <?php }else{ ?>
            <li class="nav-item dropdown col-md-3"><div class="dropdown-menu"></div></li>
            <li class="nav-item col-md-3 ">
                <a href = "/log" style = 'text-transform : uppercase' class= 'nav-link'>
                    <h5 class = 'menu'>Connexion</h5>
                </a>
            </li>
        <?php } ?>

    </ul>
</header>