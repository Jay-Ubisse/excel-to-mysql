<?php

$host_name = "localhost";
$database_name = "jayubiss_pocsquareocs";
$user_name = "pocs_admin";
$password = "pocs123";

 $dbcon = new mysqli($host_name, $user_name, $password, $database_name);

if($dbcon) {
    echo "Tudo okay, bro!";
}

?>