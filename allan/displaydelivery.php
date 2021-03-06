<!DOCTYPE html>
<html lang="en-US">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=ul, initial-scale=1.0" />
      <link rel="stylesheet" type="text/css" href="css/style.css" />
      <title>Pinocone | View Delivery Status</title>
      <style>
          th, td{
            border-collapse: collapse;
          }
      </style>
    </head>
    <body>
        <?php
            require_once "inc/connect.php";
            $db = $conn;
            $table = "delivery";
            $columns = [`order_id`, `deliveryAddress`, `deliveryTime`, `deliveryStatus`, `deliveryId`];
            $fetchData = fetch_data($db, $table, $columns);
        
            function fetch_data($db, $table, $columns){
            if(empty($db)){
                $msg= "There was an error while connecting to database. Please try again.";
            }elseif (empty($columns) || !is_array($columns)) {
                $msg="column names must be defined in an indexed array";
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
                    $msg= "No data available for display"; 
                }
            }else{
                $msg= mysqli_error($db);
            }
            }
                return $msg;
            }
            $q = "SELECT `order_id`, `deliveryAddress`, `deliveryTime`, `deliveryStatus`, `deliveryId` FROM delivery";
            $result = mysqli_query($db, $q);
        ?>
        <h1 style="text-align: center;">Delivery Details</h1><br><br>
        <table style="border-collapse: collapse; width: 70%;">
            <tr>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Delivery Time</th>
                <th>Delivery Status</th>
            </tr>
        <?php
            if (mysqli_num_rows($result) > 0) {
                while($data = mysqli_fetch_assoc($result)) {
        ?>
                <tr>
                    <td><?php echo $data['order_id']; ?> </td>
                    <td><?php echo $data['deliveryAddress']; ?> </td>
                    <td><?php echo $data['deliveryTime']; ?> </td>
                    <td><?php echo $data['deliveryStatus']; ?> </td>
                <tr>
        <?php
            }} else { ?>
                <tr>
                    <td colspan="8">No data found</td>
                </tr>
        <?php } ?>
        </table>
    </body>
</html>