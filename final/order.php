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
<body>
    <?php
        include 'navigation.php';
        if(!isset($_SESSION['custid'])){
            header("location: index.php");
            exit();
        }
    ?>
    <div class="orders">
        <div class="order-title">
            <h1 class="title">Your Orders</h1>
        </div>

        <div class="order-content">
            <?php 
                $loggedID = $_SESSION["custid"];
            ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Delivery Address</th>
                        <th>Payment Type</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $osql = "SELECT * FROM custorders WHERE custID = $loggedID";
                        $oquery = mysqli_query($conn, $osql);
                        while ($ofetch = mysqli_fetch_assoc($oquery)) {
                    ?>
                    <tr>
                        <td><?php echo $ofetch['orderID']; ?></td>
                        <td><?php echo $ofetch['orderQuantity']; ?></td>
                        <td>$<?php echo $ofetch['orderPrice']; ?></td>
                        <td><?php echo $ofetch['orderAddress']; ?></td>
                        <td><?php echo $ofetch['paymentType']; ?></td>
                        <td><?php echo $ofetch['orderDate']; ?></td>
                        <td><?php echo "<a href='viewOrder.php?id=".$ofetch['orderID']."'>View</a>"; ?></td>
                        <td>
							<?php if($ofetch['orderStatus'] == 'Pending'){
							    echo "<a href='cancelOrder.php?id=".$ofetch['orderID'].">Cancel</a>";
							} ?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</body>