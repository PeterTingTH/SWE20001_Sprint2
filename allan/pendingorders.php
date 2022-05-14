<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Pinocone | View Order</title>
    </head>
    <body>
       <?php
          require_once 'inc/connect.php';
          require_once 'inc/functions.php';
          $db = $conn;
          $table = "pendingorders";
          $columns = [`order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime`];
          $fetchData = fetch_data($db, $table, $columns);

          
          $q = "SELECT `order_id`, `quantity`, `productId`, `productName`, `totalPrice`, `deliveryAddress`, `deliveryTime` FROM pendingorders";
          $result = mysqli_query($db, $q);
      ?>
      <h1 style="text-align: center;">Pending Orders</h1><br><br>
      <table style="border-collapse: collapse; width: 100%; text-align: center; padding: 10px;">
        <tr>
          <th>Order ID</th>
          <th>Quantity</th>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Total Price</th>
          <th>Delivery Address</th>
          <th>Delivery Time</th>
          <th>Cancel Order</th>
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
      <td><button class="open-btn" onclick="openForm()">Cancel</button></td>
      <div class="cancel-popup" id="cancelForm">
        <form action="cancel.php" class="cancel-container">
        <div id="cancelForm-content">
          <h3>Reason for cancellation</h3>
          <input type="text" name="reason" placeholder="Enter here.." required>
          <button type="submit" class="cancel-btn"><?php /*echo "<a href='cancelorder.php?order_id=".$data['order_id']."'>Continue</a></div>";*/$cancel = cancelOrder(); ?>Cancel</button>
          <button type="button" class="close-btn" onclick="closeForm()">X</button>
        </div>
      </form>
    </div>
    <tr>
    <?php
      }} else { ?>
        <tr>
        <td colspan="8">No pending orders</td>
        </tr>

  <?php } ?>
      </table>
      <script src="script.js"></script>
    </body>
</html>