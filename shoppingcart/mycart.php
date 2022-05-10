<!DOCTYPE html>
<html lang="en">
<?php
include("../sprint2p1/navigation.php");

?>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/cartstyle.css">
    <link rel="stylesheet" href="../sprint2p1/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cart</title>
</head>
<body>
<div class='shopping-cart'>
            <div class='title'>
                <h1 class='heading'> Shopping Cart </h1>
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
                                
                                    <button class='delete-btn fa fa-close fa-lg' name='Remove_Item' title='Delete' ></button>
                                
                                    <input type='hidden' name='Item_Name' value='$value[Item_Name]'>
                                </form>
                            </div>
                            <div class='image'>
                                <img class='Item_Img' src='$value[Item_Img]'>
                                <input type='hidden' name='Item_Img' value='$value[Item_Img]'>  
                            </div>
                            <div class='description'>
                                <h1>$value[Item_Name]</h1>
                            </div>
                            <div class='quantity'>
                                <form action='mycart.php' method='POST'>
                                <input class='quantityfield iquantity qt' name='modquantity' onchange='this.form.submit();' type='number' value='$value[Quantity]' min='1' max='50'>
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

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "itemcartdb"; //name of the enquiry database


// Establishing the connection
$conn = @mysqli_connect($servername, $username, $password, $dbname);


                    if(isset($_POST['modquantity']))
                    {
                        $quantity = $_POST['modquantity'];
                        foreach($_SESSION['cart'] as $key => $value)
                        {
                            $itemname = $value['Item_Name'];
                            if($value['Item_Name']==$_POST['Item_Name'])
                            {   
                                $sql = "UPDATE itemcart set Quantity ='$quantity' WHERE item_name='".$itemname."'";
                                $result = mysqli_query($conn,$sql) or die ( mysqli_error($conn));
                                $_SESSION['cart'][$key]['Quantity']=$_POST ['modquantity'];
                
                            echo"<script>
                                window.location.href='mycart.php';
                                </script>";
                            }
                        }
                    
                }
                    ?>

                    <?php 
                    if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0)
                    {
                    ?>
    
    
                        <form  action='../Passtask10/Checkout.php'  method='POST'>
                            <div  class='Proceedcon'>
                            <button class='Proceed'>Next</button>
                            </div>
                            <?php
                                               if(isset($_SESSION['cart'])) {
                                                foreach($_SESSION['cart'] as $key => $value)
                                                {
                            echo"
                            <input type='hidden' name='Item_Img' value=''$value[Item_Img]' />
                            <input type='hidden' name='Item_Name' value='$value[Item_Name]' />
                            <input type='hidden' name='Price' value=''$value[Price]' />
                            <input type='hidden' name='Quantity' value=''$value[Quantity]' />";
                                                }
                                            }
                                ?>
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

