<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=ul, initial-scale=1.0" />
        <meta >
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <title>Pinocone | Cancel Order</title>
    </head>
    <body>
       <?php 
            require 'view.php';
            $orderid = $_GET['order_id'];
            //date_default_timezone_set('Africa/Nairobi');
            //$date = strtotime(date('d-m-y h:i:s'));
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
                            die('Delete failed.');
                        }else{                        
                            echo "<script> alert('Your order was cancelled successfully'); </script>";

                            mysqli_close($con);

                            echo "<meta http-equiv='refresh' content='0'>";
                            //echo $time;
                        }
                    }else{
                        die('Error selecting order.');
                    }
                }else{
                    echo "<script> alert('Invalid order ID'); </script>";

                           /* mysqli_close($con);

                            echo "<meta http-equiv='refresh' content='0'>";*/
                    }
           /* } else {
                echo "Your time limit of 1 hour before delivery time has passed.<br><br>";
                echo $difference;
            }*/

        ?>
    </body>
</html>