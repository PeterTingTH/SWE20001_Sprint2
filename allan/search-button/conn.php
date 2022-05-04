<?php

$con = mysqli_connect("localhost", "root", "", "orderdb");

if(!$con){
    echo die("Error: Failed to connect to database");
}

?>