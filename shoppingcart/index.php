<!DOCTYPE html>
<html lang="en">
<?php
include("nav.php");
?>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/productstyle.css">
    <link rel="stylesheet" href="css/popupstyle.css">
    <title>Product</title>
</head>
<body>
<div id='popup1' class='overlay'>
                <div class='popup'>
        
                    <div class='alert'>
                    Item Added to Cart
                    </div>
                </div>
                </div>
    <div class='container'>
        <div class='row'>
                <div class='col'>
                        <form action='manage_cart.php' method='POST'>
                            <div class='card'>
                                <img src='images/apple.png' class='card-img-top' >
                               
                                <h1 class='card_title'>Apple Juice</h1>
                                <p class='price'>Price: $10</p>
                                        <button type='submit' href="#popup1" name='Add_To_Cart' class='btn btn_info'>Add to Cart </button>
                                        <input type='hidden' name='Item_Img' value='images/apple.png' />
                                        <input type='hidden' name='Item_Name' value='Apple Juice' />
                                        <input type='hidden' name='Price' value='10.00' />
                                        <input type='hidden' name='Quantity' value='0' />
                                        <input type='hidden' name='Subtotal' value='10.00' />
                    
                            </div>
                            
                        </form>
                </div>
        </div>
        <div class='row'>
                <div class='col'>
                        <form action='manage_cart.php' method='POST'>
                            <div class='card'>
                                <img src='images/grapes.png' class='card-img-top' >
                               
                                <h1 class='card_title'>Grape Juice</h1>
                                <p class='price'>Price: $9</p>
                                        <button type='submit' name='Add_To_Cart' class='btn btn_info'>Add to Cart </button>
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

