<?php
session_start();
include 'config.php';
?>
<header>
    <div class="title"><a href="./home.php">Sklep<i class="demo-icon icon-video"></i></a></div>
    <div class="spacer"></div>
    <?php

    if (isset($_SESSION["role"]) && $_SESSION["role"]) {
        echo '<div><a href="./add.php">Dodaj nowy film <i class="demo-icon icon-plus"></i></a></div>';
    }
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
        echo '<div><a href="./logout.php">Logout</a></div>';
        echo '<div><a href="./koszyk.php">Koszyk</a></div>';
        echo '<div><a href="./profile.php">Profil</a></div>';
    } else {
        echo '<div><a href="./login.php">Logowanie<i class="demo-icon icon-login"></i></a>/<a href="./register.php">Rejestracja<i class="demo-icon icon-user-plus"></i></i></a></div>';
    }
    ?>
</header>