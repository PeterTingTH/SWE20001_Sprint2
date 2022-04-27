<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <meta name="author" content="Allan" />
      <meta name="keywords" content="CancelOrder" />
      <meta name="description" content="CancelOrder" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Pinocone | Cancel Orders</title>
    </head>
    <body>
        <?php include 'navigation.php'; ?>
        <?php
            include 'connect.php';

            $id=$_POST['number'];

            $q="SELECT COUNT(1) FROM ordertable WHERE order_id=$id";
            $r=mysqli_query($con, $q);
            $row=mysqli_fetch_row($r);

            if($row[0] >= 1) {
                mysqli_query($con, "DELETE FROM ordertable WHERE order_id=$id");
                echo "Order ID Deleted<br>";
            } else {
                echo "Record doesn't exist<br>";
            }

            mysqli_close($con);

        ?>
        <a href="view.php">Back to viewing orders</a>
        <!--<script>
        window.open('http://localhost/OCS/order/view.php');
        </script>-->
        <footer>
            <i><p>Copyright © Pinocone Online Catering System <br>All rights reserved.</p></i>
        </footer>
    </body>
</html>
