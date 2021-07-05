<?php
//$link = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<style>
.dropdown-menu a:hover {
    background-color: #9bff80;
}

.dropdown:hover .dropdown-menu {
    display: block;
}

.dropdown:hover .dropdown-toggle {
    background-color: #66ff33;
}

body {
    background-color: powderblue;
}
</style>
<link rel="stylesheet" href="style.css">

  


<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/medical/index" title="Jurnalul tău medical">
            <img id="brand-image" alt="Website logo" src="/medical/images/medical-logo.jpg"> Jurnalul tău medical
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="div1 d-inline"><a href="/medical/coronavirus">⚠ COVID-19 INFORMAȚII</a></div>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!--pt ca elem sa fie pe acelasi rand, nu pe coloana, care e default-->
            <div class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a id="_122" class="nav-link" href="/medical/forum">Forum</a>
                </li>
                <li class="nav-item">
                <li class="nav-item">
                    <a id="_123" class="nav-link" href="/medical/boli">Boli</a>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="dictionarDropdown"
                            aria-haspopup="true" aria-expanded="false" href="">Dicționar medical</a>
                        <div class="dropdown-menu" aria-labelled="dictionarDropdown">
                            <a class="dropdown-item" href="/medical/medicamente">Medicamente</a>
                            <a class="dropdown-item" href="/medical/plantemedicinale">Plante medicinale</a>
                            <a class="dropdown-item" href="/medical/simptome">Semne și simptome</a>
                        </div>
                    </div>
                </li>

                <?php
                if(!isset($_SESSION['username'])){ ?>
                <li class="nav-item">
                    <a id="_125" class='nav-link' href='/medical/login'> Login</a>
                </li>
                <li class="nav-item">
                    <a id="_126" class='nav-link' href='/medical/register'> Register</a>
                </li>
                <?php }
                else if(isset($_SESSION['rolecode']) && ($_SESSION['rolecode'] =='ADMIN')){
                    ?>
                <li class="nav-item">
                    <a id="_127" class='nav-link ' href='/medical/profile'> Profilul meu</a>
                </li>
                <li class="nav-item">
                    <a id="_128" class='nav-link ' href='/medical/adminpanel'> Admin Panel</a>
                </li>
                <li class="nav-item">
                    <a id="_129" class='nav-link ' href='/medical/logout'> Logout</a>
                </li>
                <?php } 
                else { ?>
                <li class="nav-item">
                    <a id="_127" class='nav-link ' href='/medical/profile'> Profilul meu</a>
                </li>
                <li class="nav-item">
                    <a id="_129" class='nav-link ' href='/medical/logout'> Logout</a>
                </li>
                <?php } ?>
            </div>

        </div>
</nav>