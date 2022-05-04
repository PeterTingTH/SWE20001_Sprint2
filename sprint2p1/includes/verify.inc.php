<?php
session_start();

if (isset($_GET['vkey'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $vkey = $_GET['vkey'];

    if (vkeyExist($conn, $vkey) == false){
        header("location: ../login.php?error=invalid");
        exit();
    } else {
        if (isset($_GET['delete'])){
            deleteUnactivateAccount($conn,$vkey);
        } else {
            validateEmail($conn,$vkey);
        }
    }
} else {
    header("location: ../index.php");
    exit();
}