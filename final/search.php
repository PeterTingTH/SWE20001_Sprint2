<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Murungi Allan Cheboiwo" />
    <meta name="keywords" content="Search" />
    <meta name="description" content="Search" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Menu</title>
</head>

<body>
<?php include 'navigation.php';?>
<h1 style="padding: 5%; text-align: center;">Food Menu</h1>
<div class="search-content" style="padding: 20px; text-align: center;">
    <table style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Item Name</th>
                <th>Price</th>
            </tr>
        </thead>
<?php
    if(isset($_POST['submit-search'])){
        $s_input = mysqli_real_escape_string($conn, $_POST['search-input']);

        $sql = "SELECT * FROM fooddata WHERE foodName LIKE '%$s_input%' OR foodPrice LIKE '%$s_input%'";
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);

        if ($queryResult > 0){
            while($display = mysqli_fetch_array($result)){
                $foodID = $display['foodID'];
                //echo "<h2>".$display['foodName']."</h2><p>".$display['foodPrice']."</p>";
?>
        <tbody>
            <tr>
                <td><?php echo $display['foodImg']; ?></td>
                <td><?php echo $display['foodName']; ?></td>
                <td><?php echo $display['foodPrice']; ?></td>
<?php 
            if(isset($_SESSION['custid'])){
                echo "
                <td>
                    <form action='includes/cart.inc.php' method='POST'>
                        <input type='submit' name='addFoodMenuToCart' value='Add to cart'>
                        <input type='hidden' name='chosenFoodMenu' value='$foodID'> 
                    </form> 
                </td>
            </tr>";
            } else {
                echo "</tr>";
            }
        } 
?>
            </tbody>
            </table>
        </div>
<?php
        } else {
            $no = "<script>alert('There are no results matching your search!');</script>";
            if ($no !== false){
                header("location: index.php");
                exit();
            }
        }
        mysqli_close($conn);
    }
?>