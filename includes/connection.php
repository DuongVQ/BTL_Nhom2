<?php
include_once("./config.php");
$con = new mysqli($url, $uname, $upass, $dbname);
if($con->connect_error) die("Lỗi kết nối: " . $con->connect_error);
