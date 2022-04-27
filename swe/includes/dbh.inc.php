<?php
function checkConnection($conn){
    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    };
}

function createDatabase($conn){
    $sql = "CREATE DATABASE IF NOT EXISTS swe20001";
    mysqli_query($conn, $sql);
}

function createTableUsers($conn){
    $sql = "CREATE TABLE IF NOT EXISTS custdata (
        custID INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        custName VARCHAR(128) NOT NULL,
        custEmail VARCHAR(128) NOT NULL,
        custPassword VARCHAR(128) NOT NULL,
        regDate TIMESTAMP
    )";
    
    mysqli_query($conn, $sql);
}

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "swe20001";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword);
checkConnection($conn);

createDatabase($conn);

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);
checkConnection($conn);

createTableUsers($conn);