<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Cancelled Orders</title>
    </head>
    <body>
       <?php
          include 'connect.php';
          $db = $con;
          $table = "cancelledorders";
          $columns = [`order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime`];
          $fetchData = fetch_data($db, $table, $columns);

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
          $q = "SELECT `order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime` FROM cancelledorders";
          $result = mysqli_query($db, $q);
          ?>
          <h1 style="text-align: center;">Cancelled Orders</h1><br><br>
          <table style="border-collapse: collapse; width: 100%; text-align: center; padding: 10px;
          ">
            <tr>
              <th>Order ID</th>
              <th>Quantity</th>
              <th>Product ID</th>
              <th>Product Name</th>
              <th>Total Price</th>
              <th>Delivery Address</th>
              <th>Delivery Time</th>
            </tr>
          <?php
          if (mysqli_num_rows($result) > 0) {
            while($data = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $data['order_id']; ?> </td>
            <td><?php echo $data['quantity']; ?> </td>
            <td><?php echo $data['productId']; ?> </td>
            <td><?php echo $data['productName']; ?> </td>
            <td><?php echo $data['totalPrice']; ?> </td>
            <td><?php echo $data['deliveryAddress']; ?> </td>
            <td><?php echo $data['deliveryTime']; ?> </td>
            </tr>
          <?php
            }} else { ?>
              <tr>
              <td colspan="8">No cancelled orders</td>
              </tr>

        <?php } ?>
            </table>
    </body>
</html>