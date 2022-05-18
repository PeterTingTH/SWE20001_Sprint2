<?php
session_start();

if (isset($_POST["checkoutCart"])){

    $totalPayment = $_POST["totalPayment"];
    $paymentMethod = $_POST["paymentMethod"];
    $time = $_POST["time"];
    $orderMsg = $_POST["orderMsg"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION['custid'];
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $testAddress = "lol";

    

    $items = 0;
    $last_id = 0;

    $qry = mysqli_query($conn, "SELECT * FROM custcart WHERE custID = $loggedID");

    while($result = mysqli_fetch_assoc($qry)){
        $food_ID = $result["foodID"];
        $quantity = $result["quantity"];
        $subtotal = $result["subtotal"];

        if($items == 0){
            $sql = "INSERT INTO pendingorders (foodID, custID, orderQuantity, orderPrice, orderAddress, paymentType, orderMsg, orderDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                mysqli_close($conn);
                header("location: ../checkout.php?error=stmtfailed");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "ssssssss", $food_ID, $loggedID, $quantity, $subtotal, $testAddress, $paymentMethod, $orderMsg, $time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            
            $items += 1;
            $last_id = mysqli_insert_id($conn);
        } else {
            $sql = "INSERT INTO pendingorders (orderID, foodID, custID, orderQuantity, orderPrice, orderAddress, paymentType, orderMsg, orderDate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                mysqli_close($conn);
                header("location: ../checkout.php?error=stmtfailed");
                exit();
            }
    
            mysqli_stmt_bind_param($stmt, "sssssssss", $last_id, $food_ID, $loggedID, $quantity, $subtotal, $testAddress, $paymentMethod, $orderMsg, $time);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }

    /* Finish inserting */
    $query = "DELETE FROM custcart where custID = '$loggedID';";
    $result = mysqli_query($conn,$query);

    

    mysqli_close($conn);
    header("location: ../order.php");
    exit();

} else if (isset($_POST["paymentBack"])){
    header("location: ../mycart.php");
    exit();
} else {
    header("location: ../index.php");
    exit();
}