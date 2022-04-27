<!DOCTYPE html>
<html lang="en">
<?php
include("nav.php");

?>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/cartstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cart</title>
</head>
<body>
<div class='shopping-cart'>
            <div class='title'>
                <h1 class='heading'> My Shopping Cart </h1>
            </div>

                    <?php
                    if(isset($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $values = $value['Quantity'];
                        $number=$key+1;
                       
                        echo"
                        <div class='item'>
                            <div class='btns'>
                                <form action='manage_cart.php' method='POST'>
                                
                                    <button class='delete-btn fa fa-close fa-lg' name='Remove_Item' ></button>
                                
                                    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                </form>
                            </div>
                            <div class='image'>
                                <img class='Item_Img' src='$value[Item_Img]'>
                            </div>
                            <div class='description'>
                                <h1>$value[Item_Name]</h1>
                            </div>
                            <div class='quantity'>
                                <form action='manage_cart.php' method='POST'>
                                <input class='quantityfield iquantity qt' name='modquantity' onchange='this.form.submit()'type='number' value='$value[Quantity]' min='1' max='50'>
                                <input type='hidden' name='Item_Name' value='$value[Item_Name]'>  
                                </form>
                            </div>
                            <div class='price' >
                            <span class='itotal'></span>
                                 <input type='hidden' class='iprice' value='$value[Price]'>
                            </div>
                            
                           
                            
                        </div>
                        

                        ";

                    }
                }
                    ?>

                    <?php 
                    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                    {
                    ?>
    
    
                        <form>
                            <div  class='Proceedcon'>
                            <button class='Proceed'>Next</button>
                            </div>
                        </form> 
                    </div>
                    <?php
                    }
                    else{
                    ?>
                    <div class='emptycartcon'>
                        <h1 class='emptycart'>Your Cart is Empty!</h1>
                    </div>
                    </div>
                    <?php
                    }
                    ?>
  
                        
              
               
            
           
            <script src="cart.js"></script>
            </body>
            </html>

