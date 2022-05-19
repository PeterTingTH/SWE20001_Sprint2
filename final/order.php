<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta charset="author" content="Murungi Allan Cheboiwo">
    <meta charset="desciption" content="Order Page">
    <meta charset="keyword" content="Contains a customer's orders">
    <title>Orders</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body id="order_page">
    <?php
        include 'navigation.php';
        if(!isset($_SESSION['custid'])){
            header("location: index.php");
            exit();
        }
    ?>
    <div class="orders">
        <div class="order-title">
            <h1 class="title">Your Orders</h1><br>
        </div>

        <div class="order-content">
            <?php 
                $loggedID = $_SESSION["custid"];
                $db = $conn;
                $table = "custorders";
                $columns = [`orderID`, `foodID`, `custID`, `orderQuantity`, `orderPrice`, `orderAddress`, `paymentType`, `orderMsg`, `orderDate`, `orderReceived`, `orderStatus`];
                $fetchData = fetch_data($db, $table, $columns);

                function fetch_data($db, $table, $columns){
                if(empty($db)){
                    $msg= "Database connection error";
                }elseif (empty($columns) || !is_array($columns)) {
                    $msg="columns Name must be defined in an indexed array";
                }elseif(empty($table)){
                    $msg= "Table is empty";
                }else{
                    $columnName = implode(", ", $columns);
                    $query = "SELECT ".$columnName." FROM $table"." ORDER BY orderID DESC";
                    $result = $db->query($query);

                    if($result== true){ 
                    if ($result->num_rows > 0) {
                        $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
                        $msg= $row;
                    } else {
                        $msg= "No Data Found"; 
                    }
                    }else{
                    $msg= mysqli_error($db);
                    }
                }
                    return $msg;
                }
                $q = "SELECT * FROM custorders";
                $result = mysqli_query($db, $q);
            ?>
            <table class = "orders-table">
                <tr>
                <th>Order ID</th>
                <th>Food ID</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Delivery Address</th>
                <th>Payment Type</th>
                <th>Order Date</th>
                <th>Order Received</th>
                <th>Order Status</th>
                <th>View / Cancel</th>
                </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while($data = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $data['orderID']; ?> </td>
                <td><?php echo $data['foodID']; ?> </td>
                <td><?php echo $data['orderQuantity']; ?> </td>
                <td>RM<?php echo $data['orderPrice']; ?> </td>
                <td><?php echo $data['orderAddress']; ?> </td>
                <td><?php echo $data['paymentType']; ?> </td>
                <td><?php echo $data['orderDate']; ?> </td>
                <td><?php echo $data['orderReceived']; ?> </td>
                <td><?php echo $data['orderStatus']; ?> </td>
                <td><a href="viewOrder.php?food=<?php echo $data['foodID']; ?>">View Order</a><?php if($data['orderStatus'] != 'Order Cancelled'){?> / <button type="submit"><?php echo "<a href='includes/cancelOrder.inc.php?id=".$data['orderID']."&time=".$data['orderDate']."'>Cancel</a></div>";?></button><?php } ?></td> 
            <tr>
            <?php
                }} else { ?>
                <tr>
                <td colspan="8">No Orders</td>
                </tr>

            <?php } ?>
                </table>
        </div>
    </div>
</body>