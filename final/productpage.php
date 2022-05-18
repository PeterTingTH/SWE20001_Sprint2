<!DOCTYPE html>
<html lang="en">
<?php include 'navigation.php';?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Leonard" />
    <meta name="keywords" content="Shopping Cart" />
    <meta name="description" content="Shopping Cart" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/productstyle.css">
    <title>Product</title>
</head>
<body>
    <div >
        <div class='row'>
                <div class='col'>
                        <form action='includes/cart.inc.php' method='POST'>
                            <div class='card'>
                                <img src='images/apple.png' class='card-img-top' >
                               
                                <h1 class='card_title'>Apple Juice</h1>
                                <p class='price'>Price: $10</p>
                                <select>
                                    <option value='warm'>Warm</option>
                                    <option value='cold'>Cold</option>
                                </select>
                                        <button type='submit' href="#popup1" name='addFoodMenuToCart' class='btn btn_info'>Add to Cart </button>
                                        <input type='hidden' name='Item_Img' value='images/apple.png' />
                                        <input type='hidden' name='Item_Name' value='Apple Juice' />
                                        <input type='hidden' name='Type' value='Warm' />
                                        <input type='hidden' name='Price' value='10.00' />
                                        <input type='hidden' name='Quantity' value='0' />
                                        <input type='hidden' name='Subtotal' value='10.00' />
                                       
                    
                            </div>
                            
                        </form>
                </div>
        </div>
        <div class='row'>
                <div class='col'>
                        <form action='includes/cart.inc.php' method='POST'>
                            <div class='card'>
                                <img src='images/grapes.png' class='card-img-top' >
                               
                                <h1 class='card_title'>Grape Juice</h1>
                                <p class='price'>Price: $9</p>
                                <select>
                                    <option value='warm'>Warm</option>
                                    <option value='cold'>Cold</option>
                                </select>
                                        <button type='submit' name='addFoodMenuToCart' class='btn btn_info'>Add to Cart </button>
                                        <input type='hidden' name='Item_Img' value='images/grapes.png' />
                                        <input type='hidden' name='Item_Name' value='Grape Juice' />
                                        <input type='hidden' name='Price' value='9.00' />
                                        <input type='hidden' name='Quantity' value='0' />
                                        <input type='hidden' name='Subtotal' value='9.00' />
                                    
                                
                            </div>
                        </form>
                </div>
        </div>
        
    </div>
</body>
</html>

