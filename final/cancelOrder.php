<?php error_reporting (E_ALL ^ E_NOTICE); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta charset="author" content="Murungi Allan Cheboiwo">
    <meta charset="desciption" content="Cancel Order">
    <meta charset="keyword" content="Cancel a customer's order">
    <title>Cancel order</title>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<?php
    include 'navigation.php';
    if(!isset($_SESSION['custid'])){
        header("location: index.php");
        exit();
    }

    $loggedID = $_SESSION["custid"];
    $fetched = $_GET['orderID'];
    if(ctype_digit($fetched)){
        $sql = "INSERT INTO custcancelledorders SELECT orderID, foodID, custID, orderQuantity, orderPrice, orderAddress, paymentType, orderMsg, orderDate FROM custorders WHERE orderID = $fetched";
        if(mysqli_query($conn, $sql)){
            $ordupdate = "UPDATE custorders SET orderstatus='Cancelled' WHERE orderID = $fetched";
            if(mysqli_query($conn, $sql2)){
                echo "<script> alert('Your order was cancelled successfully'); </script>";
            }else{                        
                die('Updating database failed.');
            }
        }else{                    
            die('Cancel failed.');
        }
    }else{
        die('Error selecting order.');
    }
?>
<div class="orders">
    <div class="order-title">
        <h1 class="title">Cancelled Orders</h1>
    </div>

    <div class="order-content">
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
                    $osql = "SELECT * FROM custcancelledorders WHERE custID = $loggedID";
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
                    <td>
                        <?php echo "<a href='viewOrder.php?id=".$ofetch['orderID']."'>View</a>"; ?>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php mysqli_close($conn); ?>
</body>
</html>