<!--
include_once('./templates/navbar.php');
--->

<?php if (isset($_SESSION['uid'])) { ?>

    <nav>
        <div class="nav-wrapper">
            <a href="./index.php" class="brand-logo">Forest Lover</a>
            <a href="#" data-target="collapsable_menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="./galeria.php">Galeria</a></li>
                <li><a href="./explorar.php">Explorar</a></li>
                <li><a href="./perfil.php">Perfil</a></li>
                <li><a href="./logout.php">Salir</a></li>
                <li>
                    <a href="search.php">
                        <i class="material-icons">search</i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="collapsable_menu">
        <li>Galeria</li>
        <li>
            <a href="search.php">
                <i class="material-icons">search</i>
            </a>
        </li>
        <li><a hrefexplorar.php">Ecplorar</a></li>
        <li><a href="badges.html">Perfil</a></li>

        <li><a href="./logout.php">Salir</a></li>
    </ul>


<?php } else { ?>

    <nav>
        <div class="nav-wrapper">
            <a href="./index.php" class="brand-logo">Forest Lover</a>
            <a href="#" data-target="collapsable_menu" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="./galeria.php">Galeria</a></li>
                <li><a href="./galeria.php">Explorar</a></li>
                <li><a href="./login.php">Inicie Sesion</a></li>
                <li>
                    <a href="search.php">
                        <i class="material-icons">search</i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <ul class="sidenav" id="collapsable_menu">
        <li><a href="./galeria.php">Galeria</a></li>
        <li><a href="./galeria.php">Explorar</a></li>
        <li><a href="./perfil.php">Perfil</a></li>
        <li>
            <a href="search.php">
                <i class="material-icons">search</i>
            </a>
        </li>
    </ul>

<?php } ?>