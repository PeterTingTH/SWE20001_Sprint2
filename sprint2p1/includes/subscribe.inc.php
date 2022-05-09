<?php
session_start();

if (isset($_POST["subscribeMembership"])){

    $membershipPlanOption = $_POST["membershipPlanOption"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION['custid'];

    date_default_timezone_set("Asia/Kuala_Lumpur");

    if(!activeMemberPaymentExist($conn,$loggedID)){
        if($membershipPlanOption == "dailySubscription"){
            $membershipExpire = date('Y-m-d H:i:s', strtotime(' + 1 day'));
            subscribeMembership($conn,$loggedID,"Daily Subscription",0.30,$membershipExpire);
        }
        if($membershipPlanOption == "monthlySubscription"){
            $membershipExpire = date('Y-m-d H:i:s', strtotime(' + 1 month'));
            subscribeMembership($conn,$loggedID,"Monthly Subscription",8.90,$membershipExpire);
        }
        if($membershipPlanOption == "biannuallySubscription"){       
            $membershipExpire = date('Y-m-d H:i:s', strtotime('+ 6 months'));
            subscribeMembership($conn,$loggedID,"Biannually Subscription",41.40,$membershipExpire);
        }
        if($membershipPlanOption == "yearlySubscription"){       
            $membershipExpire = date('Y-m-d H:i:s', strtotime('+ 12 months'));
            subscribeMembership($conn,$loggedID,"Yearly Subscription",58.80,$membershipExpire);
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