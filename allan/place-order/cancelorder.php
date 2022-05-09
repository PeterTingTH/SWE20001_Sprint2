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
    
        $orderid = $_GET['order_id'];
        if(ctype_digit($orderid)){
            //connect to database
            require "connect.php";
            
            //create a variable to select data from pending orde4s then insert it into cancelled orders
            $sql = "INSERT INTO cancelledorders  SELECT `order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime` FROM pendingorders WHERE `order_id` = {$orderid}";
            $query = mysqli_query($con, $sql);

            if($query !== false){
                $sql2 = "DELETE FROM pendingorders WHERE `order_id` = {$orderid}";
                $res2 = mysqli_query($con, $sql2);

                if($res2 !== false){
                    echo "<script> alert('Your order was cancelled successfully'); </script>";
                }else{                        
                    die('Delete failed.');
                }

            }else{                    
                die('Insert failed.');
            }
        }else{
            die('Error selecting order.');
        }

        mysqli_close($con);

    ?>
</body>
</html>