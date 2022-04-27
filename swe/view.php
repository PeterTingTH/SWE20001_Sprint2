<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <meta name="author" content="Allan" />
      <meta name="keywords" content="ViewOrder" />
      <meta name="description" content="ViewOrder" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Pinocone | View Orders</title>
    </head>
    <body>
        <?php include 'navigation.php'; ?>
        <?php
          include 'connect.php';
          $db = $con;
          $table = "ordertable";
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
          //include('vieworder.php');
          $q = "SELECT `order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime` FROM ordertable";
          $result = mysqli_query($db, $q);
          ?>
          <h1 style="text-align: center;">Your Orders</h1><br><br>
          <table style="border-collapse: collapse; width: 100%; text-align: center; padding: 10px;
          ">
            <tr>
              <th>Serial Number</th>
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
            $sn=1;
            while($data = mysqli_fetch_assoc($result)) {
          ?>
          <tr>
            <td><?php echo $sn; ?> </td>
            <td><?php echo $data['order_id']; ?> </td>
            <td><?php echo $data['quantity']; ?> </td>
            <td><?php echo $data['productId']; ?> </td>
            <td><?php echo $data['productName']; ?> </td>
            <td><?php echo $data['totalPrice']; ?> </td>
            <td><?php echo $data['deliveryAddress']; ?> </td>
            <td><?php echo $data['deliveryTime']; ?> </td>
          <tr>
          <?php
            $sn++;}} else { ?>
              <tr>
              <td colspan="8">No data found</td>
              </tr>

        <?php } ?>
        </table>
    </body>
</html>