<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Leonard" />
    <meta name="keywords" content="Shopping Cart" />
    <meta name="description" content="Shopping Cart" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <title>Cart</title>
</head>

<body id="shopping_cart_page">
    <?php include 'navigation.php';?>
    <div class='shopping-cart'>
        <div class='title'>
            <h1 class='heading'>Shopping Cart </h1>
        </div>
        
        <?php
            $loggedID = $_SESSION["custid"];

            $qry = mysqli_query($conn, "SELECT * FROM custcart WHERE custid = $loggedID");

            $found = FALSE;

            while($result = mysqli_fetch_assoc($qry)){
                $found = TRUE;

                $food_ID = $result["foodID"];
                $quantity = $result["quantity"];
                $subtotal = $result["subtotal"];

                $foodExists = foodExists($conn,$food_ID);
                $foodName = $foodExists["foodName"];
                $foodImg = $foodExists["foodImg"];
                $foodPrice = $foodExists["foodPrice"];

                echo "
                    <div class='item'>
                        <div class='btns'>
                            <form action='includes/cart.inc.php' method='POST'>
                                <button class='delete-btn fa fa-close fa-lg' name='remove_Item' title='Delete' ></button>
                                <input type='hidden' name='del_item' value='$food_ID'>
                            </form>
                        </div>
                        <div class='image'>
                            <img class='Item_Img' src='$foodImg'>
                        </div>
                        <div class='description'>
                            <h1>$foodName</h1>
                        </div>
                        
                        <div class='quantity'>
                            <form action='includes/cart.inc.php' method='POST'>
                                <input name='modquantity' onchange='this.form.submit();' type='number' value='$quantity' min='1' max='50'>
                                <input type='hidden' name='mod_Item_ID' value='$food_ID'>  
                            </form>
                        </div>
                        <div class='price'>
                            <span>RM$subtotal</span>
                        </div>
                    </div>
                ";
            }

            if($found == FALSE){
        ?>

        <div class='emptycartcon'>
            <h1 class='emptycart'>Your Cart is Empty!</h1>
        </div>

        <?php
            } else {
        ?>
            <form  action='checkout.php' method='POST'>
                <div class='Proceedcon'>
                    <button class='Proceed' name='Proceed' type='submit'>Next</button>
                </div>
            </form> 

        <?php
            }
            mysqli_close($conn);
        ?>
    </div>
</body>
</html>