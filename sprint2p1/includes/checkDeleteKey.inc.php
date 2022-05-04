<?php
session_start();

if (isset($_GET['deleteAccKey'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $deleteAccKey = $_GET['deleteAccKey'];

    if (!isset($_SESSION['custid'])){
        mysqli_close($conn);
        header("location: ../errorLoggedAcc.php");
        exit();
    }

    $loggedID = $_SESSION['custid'];

    if (deleteAccKeyExist($conn, $deleteAccKey) == false){
        mysqli_close($conn);
        header("location: ../deleteAccConfirmation.php?error=invalid");
        exit();
    } else {
        $deleteK = deleteAccKeyExist($conn, $deleteAccKey);
        $linkExpireT = $deleteK["deleteAccExpires"];
        $idRequest = $deleteK["deleteAccCustID"];
        if($loggedID != $idRequest){
            mysqli_close($conn);
            header("location: ../errorLoggedAcc.php");
            exit();
        } else {
            if (checkLinkExpire($linkExpireT)){
                mysqli_close($conn);
                header("location: ../deleteAccConfirmation.php?error=expire");
                exit();
            } else {
                if (isset($_GET['delete'])){
                    removeDeleteAccKey($conn,$idRequest);
                    mysqli_close($conn);
                    header("location: ../deleteAccConfirmation.php?error=cancelled");
                    exit();
                } else {
                    deleteCustAcc($conn,$idRequest);
                    mysqli_close($conn);
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