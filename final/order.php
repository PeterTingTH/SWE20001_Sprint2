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
    <h1 class="title">Your Orders</h1><br>
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
                <th>Order Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $osql = "SELECT * FROM custorders WHERE custID = $loggedID";
                $oquery = mysqli_query($conn, $osql);
                while ($ofetch = mysqli_fetch_array($oquery)) { 
                    $ids = $ofetch['orderID'];                 
            ?>
            <tr>
                <td><?php echo $ids; ?></td>
                <td><?php echo $ofetch['orderQuantity']; ?></td>
                <td>$<?php echo $ofetch['orderPrice']; ?></td>
                <td><?php echo $ofetch['orderAddress']; ?></td>
                <td><?php echo $ofetch['paymentType']; ?></td>
                <td><?php echo $ofetch['orderDate']; ?></td>
                <td><?php echo $ofetch['orderStatus']; ?></td>
                <td><?php if ($ofetch['orderStatus'] == "InProgress") { ?><button class="open-btn" onclick="openForm()">Cancel</button> <?php }?></td>
                <div class="cancel-popup" id="cancelForm">
                    <form action="cancel.php" class="cancel-container">
                        <div id="cancelForm-content">
                            <input type="text" name="reason" placeholder="Reason for cancellation" required><br><br>
                            <button type="submit" class="cancel-btn"><?php echo "<a href='includes/cancelOrder.inc.php?order_id=".$ofetch['orderID']."&deliveryTime=".$ofetch['orderDate']."'>Continue</a></div>";?></button>
                            <span class="close-btn" onclick="closeForm()">×</span>
                        </div>
                    </form>
                </div>
            </tr>
            <?php }?>
        </tbody>
    </table>
    <script>
        function openForm() {
        document.getElementById("cancelForm").style.display = "block";
        }

        function closeForm() {
        document.getElementById("cancelForm").style.display = "none";
        }
    </script>
</div>
</div>
</body>