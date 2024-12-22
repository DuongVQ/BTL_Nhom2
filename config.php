<?php
$url = "localhost";
$uname = "root";
$upass = "";
$dbname = "manager_user";

$con = new mysqli($url, $uname, $upass, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}