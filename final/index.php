<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" >
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Home" />
    <meta name="description" content="Home" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Home</title>
</head>

<body>
    <?php include 'navigation.php';?>
    <h1 style="padding-top: 50px; text-align: center;">Food Menu</h1>
    <div class="search-class">
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
<<<<<<< HEAD
        <table class='orders-table'>
=======
        <table class='indextable'>
>>>>>>> c9679cb3ff92919fa35027ed9b7a4eccdf3fb0af
        <tr>
        <th class='tableheading'>Name</th>
        <th class='tableheading'>Image</th>
        <th class='tableheading'>Price</th>";
        if(isset($_SESSION['custid'])){
            echo "
        <th class='tableheading'>Button</th>
        ";
        }
        echo" </tr>
        ";

        while($result = mysqli_fetch_assoc($qry)){
            $foodID = $result["foodID"];
            $foodName = $result["foodName"];
            $foodImg = $result["foodImg"];
            $foodPrice = $result["foodPrice"];

            echo "
            <tr class='tablerow'>
            <td class='tablein'>$foodName</td>
            <td class='tablein'><img src='$foodImg' class='testFoodMenu '></td>
        
            <td class='tablein'>RM $foodPrice</td>";

            if(isset($_SESSION['custid'])){
                echo "
                <td class='tablein'>
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