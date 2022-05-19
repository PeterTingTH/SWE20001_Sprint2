<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Murungi Allan Cheboiwo" />
    <meta name="keywords" content="View Order" />
    <meta name="description" content="View Order" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>View Order</title>
</head>

<body>
<?php include 'navigation.php';?>
<h1 style="padding-top: 50px; padding-bottom: 10px; text-align: center;">Food Menu</h1>
<div class="orders" style=" text-align: center;">
    <table class="orders-table">
        <thead>
            <tr>
                <th>Food ID</th>
                <th></th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
        </thead>
<?php
    if(isset($_GET) && !empty($_GET)){
        $fetched = $_GET['food'];

        $sql = "SELECT * FROM fooddata WHERE foodID=$fetched";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0){
            while($display = mysqli_fetch_assoc($result)){
                $foodID = $display['foodID'];
                $foodImg = $display['foodImg'];
                $foodName = $display['foodName'];
                $foodPrice = $display['foodPrice'];
?>
        <tbody>
            <?php echo "
            <tr>
                <td>$foodID</td>
                <td><img src='$foodImg' class='testFoodMenu'></td>
                <td>$foodName</td>
                <td>RM$foodPrice</td>
            </tr>";
        } 
?>
            </tbody>
            </table>
        </div>
<?php
        }
        mysqli_close($conn);
    }
?>