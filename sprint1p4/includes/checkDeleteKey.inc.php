<?php
session_start();

if (isset($_GET['deleteAccKey'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $deleteAccKey = $_GET['deleteAccKey'];

    if (!isset($_SESSION['custid'])){
        header("location: ../errorLoggedAcc.php");
        exit();
    }

    $loggedID = $_SESSION['custid'];
    $currentCust = custExist($conn,$loggedID,"id");
    $currentCustEmail = $currentCust['custEmail'];

    if (deleteAccKeyExist($conn, $deleteAccKey) == false){
        header("location: ../deleteAccConfirmation.php?error=invalid");
        exit();
    } else {
        $deleteK = deleteAccKeyExist($conn, $deleteAccKey);
        $linkExpireT = $deleteK["deleteAccExpires"];
        $emailRequest = $deleteK["deleteAccEmail"];
        if($currentCustEmail != $emailRequest){
            header("location: ../errorLoggedAcc.php");
            exit();
        } else {
            if (checkLinkExpire($conn, $linkExpireT)){
                header("location: ../deleteAccConfirmation.php?error=expire");
                exit();
            } else {
                if (isset($_GET['delete'])){
                    removeDeleteAccKey($conn,$emailRequest);
                    header("location: ../deleteAccConfirmation.php?error=cancelled");
                    exit();
                } else {
                    deleteCustAcc($conn,$emailRequest);
                    header("location: ../successDeleteAcc.php");
                    exit();
                }
            }
        }
    }

} else {
    header("location: ../index.php");
    exit();
}