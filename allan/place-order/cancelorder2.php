<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=ul, initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Pinocone | Cancel Order</title>
    </head>
    <body>
       <header>
        <div class="navbar">
            <img src="images/png.png" alt="logo image" class="logo">
            <!--Navigation-->
            <nav>
                <!--Search box container-->
                <div class="navsearch">
                    <form action="search_bar.php" class="search-box-container" >
                        <input type="search" id="search-box" placeholder="Search for product..">
                        <label for="search-box" class="id-search"></label>
                    </form>
                </div>
                <a href="#">Home</a>
                <a href="#">Admin</a>
                <a href="#">Contact Us</a>
                <div class="dropdown">
                    <button class="dropbutton">More..</button>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="order.php">Orders</a>
                        <a href="cancelorder.php">Cancel an order</a>
                        <a href="view.php">View orders</a>
                        <a href="delivery.php">Delivery details</a>
                    </div>
                </div>
            </nav>
        </div>
       </header>
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