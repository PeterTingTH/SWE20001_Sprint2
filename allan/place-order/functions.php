<?php

function insertorder(){
  include 'connect.php';

  if(isset($_POST['submit'])){
  // create variable for each input field
  $quantity = $_POST['quantity'];
  $pId = $_POST['pId'];
  $pname = $_POST['pname'];
  $price = $_POST['price'];
  $delAdd = $_POST['delAdd'];
  $delTime = $_POST['dtime'];
      
  // insert SQL code into the database
  $sql = "INSERT INTO `ordertable` (`order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime`) VALUES ('0', '$quantity', '$pId', '$pname', '$price', '$delAdd', '$delTime')";
      
  // insert in database 
  $rs = mysqli_query($con, $sql);

  if ($rs){
    echo "<script>
      alert('Your order was successful!!');
    </script>";
  }

  mysqli_close($con);

  echo "<meta http-equiv='refresh' content='0'>";
  }

}
?>
