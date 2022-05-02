<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Pinocone | View Order</title>
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