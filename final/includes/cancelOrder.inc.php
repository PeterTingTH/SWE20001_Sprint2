<?php
    session_start();
    if(!isset($_SESSION['custid'])){
        header("location: ../index.php");
        exit();
    }
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    $loggedID = $_SESSION["custid"];
    date_default_timezone_set('Asia/Kuala_Lumpur');

    $orderid = $_GET['order_id'];
    $currenttime = new DateTime();
    $ordertime = new DateTime($_GET['deliveryTime']);

    $diffyear = ($ordertime->diff($currenttime)->format("%y"));
    $diffmonth = ($ordertime->diff($currenttime)->format("%m"));
    $diffday = ($ordertime->diff($currenttime)->format("%d"));
    $diffhour = ($ordertime->diff($currenttime)->format("%h"));

    //echo $diff2;
    if ($diffyear == 0 && $diffmonth ==0 && $diffday ==0 && $diffhour < 1){
        $ordupd = "UPDATE custorders SET orderStatus='Cancelled' WHERE orderID=$orderid";
        if(mysqli_query($conn, $ordupd)){
            echo "<script>alert('Order cancelled successfully');</script>";
        }
    }else {
        echo "<script>alert('You cannot cancel as your time limit has already passed (1 hour).');</script>";
    }
    echo "<meta http-equiv='refresh' content='0;../order.php' />";
?>