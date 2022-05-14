<?php

function insertorder(){
  require_once 'connect.php';

  if(isset($_POST['submit'])){
  // create variable for each input field
  $quantity = $_POST['quantity'];
  $pId = $_POST['pId'];
  $pname = $_POST['pname'];
  $price = $_POST['price'];
  $delAdd = $_POST['delAdd'];
  $delTime = $_POST['dtime'];

  //$delTime = date('d-m-y h:i:s');
      
  // insert SQL code into the database
  $sql = "INSERT INTO `pendingorders` (`order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime`) VALUES ('0', '$quantity', '$pId', '$pname', '$price', '$delAdd', '$delTime')";
      
  // insert in database 
  $rs = mysqli_query($conn, $sql);

  if ($rs){
    echo "<script>
      alert('Your order was successful!!');
    </script>";
  }

  mysqli_close($conn);

  echo "<meta http-equiv='refresh' content='0'>";
  }

}

function fetch_data($db, $table, $columns){
  if(empty($db)){
    $msg= "Database connection error";
  }elseif (empty($columns) || !is_array($columns)) {
    $msg="columns Name must be defined in an indexed array";
  }elseif(empty($table)){
    $msg= "Table is empty";
  }else{
    $columnName = implode(", ", $columns);
    $query = "SELECT ".$columnName." FROM $table"." ORDER BY order_id DESC";
    $result = $db->query($query);

    if($result== true){ 
      if ($result->num_rows > 0) {
          $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
          $msg= $row;
      } else {
          $msg= "No Data Found"; 
      }
    }else{
      $msg= mysqli_error($db);
    }
  }
    return $msg;
  }

  function cancelOrder(){
    $orderid = $_GET['order_id'];
    if(ctype_digit($orderid)){
        //connect to database
        require_once "connect.php";
        
        //create a variable to select data from pending orders then insert it into cancelled orders
        $sql = "INSERT INTO cancelledorders  SELECT `order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime` FROM pendingorders WHERE `order_id` = {$orderid}";
        $query = mysqli_query($conn, $sql);

        if($query !== false){
            $sql2 = "DELETE FROM pendingorders WHERE `order_id` = {$orderid}";
            $res2 = mysqli_query($conn, $sql2);

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

    mysqli_close($conn);
  }
?>
