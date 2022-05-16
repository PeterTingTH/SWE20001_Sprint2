<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta charset="author" content="Murungi Allan Cheboiwo">
    <meta charset="desciption" content="View Order">
    <meta charset="keyword" content="Contains details of a customer's order">
    <title>View order</title>
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
            <h1 class="title">View Order</h1>
        </div>

        <div class="order-content">
            <?php 
                $loggedID = $_SESSION["custid"];
                $fetched = $_GET['orderID'];
            ?>
            <table class = "orders-table">
                <thead>
                    <tr>
                        <th>Food ID</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $osql = "SELECT * FROM custorders WHERE custID = $loggedID && orderID=$fetched";
                        $oquery = mysqli_query($conn, $osql);
                        $ofetch = mysqli_fetch_assoc($oquery);

                        $vsql = "SELECT * FROM custorders o JOIN custcart c WHERE o.foodID=c.foodID && orderID = $fetched";
                        $vquery = mysqli_query($conn, $vsql);
                        while ($vfetch = mysqli_fetch_assoc($vquery)){
                    ?>
                    <tr>
                        <td>
                            <?php echo $vfetch['foodID']; ?>
                        </td>
                        <td>
                            <?php echo $vfetch['quantity']; ?>
                        </td>
                        <td>
                            <?php echo $vfetch['subtotal']; ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td>Order Total</td>
                        <td><?php $ofetch['orderPrice']; ?></td>
                    </tr>
                    <tr>
                        <td>Order Status</td>
                        <td><?php $ofetch['orderStatus']; ?></td>
                    </tr>
                    <tr>
                        <td>Date Received</td>
                        <td><?php echo $ofetch['orderReceived']; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>