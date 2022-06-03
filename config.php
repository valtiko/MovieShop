<?php
$con = mysqli_connect("localhost", "root", "password", "distwebproject");
$con->query("SET NAMES 'utf8'");
$link = $con;

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
