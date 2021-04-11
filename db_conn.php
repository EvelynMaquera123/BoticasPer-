<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "test_db";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);
//esta variable nos servirá para poder 
if (!$conn) {
	echo "Connection failed!";
}