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
            $orderid = $_GET['order_id'];
            date_default_timezone_set('Africa/Nairobi');
            $date = strtotime(date('d-m-y h:i:s'));
           // $time = strtotime($_GET['deliveryTime']);
            //$difference = (abs($time-$date)/3600);
/*
            $currentTime = (new DateTime('01:00'))->modify('+1 day');
            $startTime = new DateTime('22:00');
            $endTime = (new DateTime('07:00'))->modify('+1 day');

            if ($currentTime >= $startTime && $currentTime <= $endTime) {
                // Do something
            }*/

            //if($difference < 1){
                if(ctype_digit($orderid)){
                    //connect to database
                    require "connect.php";
                    
                    //create a variable to select data from order table
                    $sql1 = "SELECT * from ordertable WHERE `order_id` = {$orderid}";
    
                    $res1 = mysqli_query($con, $sql1);
    
                    //fetch data as an associative array and delete by row using the order id in 'view.php'
                    if($res1 !== false){
                        $order = mysqli_fetch_assoc($res1);
                        $sql2 = "DELETE FROM ordertable WHERE `order_id` = {$orderid}";
                        $res2 = mysqli_query($con, $sql2);
                        if(!$res2){
                            die('Delete failed.'); // TO DO: better error handling
                        }else{                        
                            echo "<script> alert('Your order was cancelled successfully'); </script>";
                            //echo $time;
                        }
                    }else{
                        die('error selecting order.');
                    }
                }else{
                    echo 'invalid order id';
                    }
           /* } else {
                echo "Your time limit of 1 hour before delivery time has passed.<br><br>";
                echo $difference;
            }*/

        ?>
        <footer>
            <i><p>Copyright © Pinocone Online Catering System <br>All rights reserved.</p></i>
        </footer>
    </body>
</html>