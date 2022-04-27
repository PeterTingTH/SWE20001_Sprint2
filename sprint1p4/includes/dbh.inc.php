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
        custPhone VARCHAR(11) NOT NULL,
        custPassword VARCHAR(128) NOT NULL,
        vKey VARCHAR(64) NOT NULL,
        verified TINYINT(1) NOT NULL DEFAULT 0,
        custMembership TINYINT(1) NOT NULL DEFAULT 0,
        custMembershipExpire DATE,
        custProfilePicStatus TINYINT(1) NOT NULL DEFAULT 0,
        regDate TIMESTAMP
    )";
    
    mysqli_query($conn, $sql);

    $sql = "CREATE TABLE IF NOT EXISTS adminData (
        adminID INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        adminName VARCHAR(128) NOT NULL,
        adminEmail VARCHAR(128) NOT NULL,
        adminPassword VARCHAR(128) NOT NULL
    )";
    
    mysqli_query($conn, $sql);

    $sql = "SELECT * FROM adminData WHERE adminID = 1;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(!$row = mysqli_fetch_assoc($resultData)){
        $adminName = "Master";
        $adminEmail = "admin1@pinocone.com";
        $adminPassword = "PinoconeSWE20001";
        $sql = "INSERT INTO adminData (adminName, adminEmail, adminPassword) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $adminName, $adminEmail, $adminPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

function createTablePasswordReset($conn){
    $sql = "CREATE TABLE IF NOT EXISTS passwordreset (
        passResetID INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        passResetEmail VARCHAR(128) NOT NULL,
        passResetKey VARCHAR(64) NOT NULL,
        passResetExpires VARCHAR(128) NOT NULL
    )";
    
    mysqli_query($conn, $sql);
}

function createTableDeleteAcc($conn){
    $sql = "CREATE TABLE IF NOT EXISTS deleteacc (
        deleteAccID INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        deleteAccEmail VARCHAR(128) NOT NULL,
        deleteAccKey VARCHAR(64) NOT NULL,
        deleteAccExpires VARCHAR(128) NOT NULL
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
createTablePasswordReset($conn);
createTableDeleteAcc($conn);