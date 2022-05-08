<?php
// connect to database
  $con = mysqli_connect('localhost', 'root', '','orderdb');

  // check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
//    $sql2 = "INSERT INTO `cancelledorders` (`order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime`) SELECT * FROM pendingorders WHERE `order_id` = {$orderid}";

?>