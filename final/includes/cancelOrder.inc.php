<?php
session_start();

if(!isset($_SESSION['custid'])){
    header("location: index.php");
    exit();
}

if(isset($_GET) && !empty($_GET)){

    require_once 'dbh.inc.php';
    date_default_timezone_set('Asia/Kuala_Lumpur');

    $loggedID = $_SESSION["custid"];
    $fetched = $_GET['id'];

    $currenttime = new DateTime();
    $deliverytime = new DateTime($_GET['time']);

    $diffhour = ($deliverytime->diff($currenttime)->format("%h"));
    //echo $diffhour;
    if($diffhour < 1){
        if ($diffhour < 0){
            $sql = " UPDATE custorders SET orderStatus = 'Complete' where orderID = $fetched";
            mysqli_query($conn, $sql);
        }
        echo "<script>alert('You cannot cancel as the order will be delivered in less than 1 hour from now.')</script>";
    } else {
        if(ctype_digit($fetched)){
            //echo "<script>alert('Still 1 hour before delivery time')</script>";
            $sql = " UPDATE custorders SET orderStatus = 'Order Cancelled' where orderID = $fetched";
            if(mysqli_query($conn, $sql)){
                echo "<script> alert('Your order was cancelled successfully'); </script>";
            } else {
                echo "<script> alert('Error updating order status code'); </script>";
            }
        }
    }

    mysqli_close($conn);
    echo "<meta http-equiv='refresh' content='0;../order.php' />";
}