<?php
session_start();

if (isset($_POST["subscribeMembership"])){

    $membershipPlanOption = $_POST["membershipPlanOptions"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION['custid'];
    $custStatus = memberExist($conn,$loggedID);
    $applyID = $custStatus['custID'];

    date_default_timezone_set("Asia/Kuala_Lumpur");

    if($custStatus["custMembership"] == 0){
        if($membershipPlanOption == "dailySubscription"){
            $membershipExpire = date('Y-m-d H:i:s', strtotime(' + 1 day'));
            subscribeMembership($conn,$applyID,$membershipExpire);
        }
        if($membershipPlanOption == "monthlySubscription"){
            $membershipExpire = date('Y-m-d H:i:s', strtotime(' + 1 month'));
            subscribeMembership($conn,$applyID,$membershipExpire);
        }
        if($membershipPlanOption == "biannuallySubscription"){       
            $membershipExpire = date('Y-m-d H:i:s', strtotime('+ 6 months'));
            subscribeMembership($conn,$applyID,$membershipExpire);
        }
        if($membershipPlanOption == "yearlySubscription"){       
            $membershipExpire = date('Y-m-d H:i:s', strtotime('+ 12 months'));
            subscribeMembership($conn,$applyID,$membershipExpire);
        }
        mysqli_close($conn);
        header("location: ../subscribed.php");
        exit();
    } else {
        mysqli_close($conn);
        header("location: ../index.php");
        exit();
    }
} else {
    header("location: ../index.php");
    exit();
}