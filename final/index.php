<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Home" />
    <meta name="description" content="Home" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Home</title>
</head>

<body>
    <?php include 'navigation.php';?>
    <div class="search-class" style="padding: 20px;">
        <form action="search.php" method="POST">
            <input type="text" name="search-input" class="search-input" placeholder="Search food">
            <button type="submit" name="submit-search" class="submit-search">Search</button>
        </form>
    </div>
    <?php
        if (isset($_SESSION['adminid'])){
            header("location: admin.php");
            exit();
        }

        $qry = mysqli_query($conn, "SELECT * FROM fooddata");

        echo "
        <table>
        <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th>Button</th>
        </tr>
        ";

        while($result = mysqli_fetch_assoc($qry)){
            $foodID = $result["foodID"];
            $foodName = $result["foodName"];
            $foodImg = $result["foodImg"];
            $foodPrice = $result["foodPrice"];

            echo "
            <tr>
            <td>$foodName</td>
            <td><img src='$foodImg' class='testFoodMenu'></td>
            <td>$$foodPrice</td>";

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

        echo "</table>";
    ?>
    
</body>

</html>