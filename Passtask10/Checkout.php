<!DOCTYPE html>
<html lang="en">
<!--Decription: Checkout page-->
<!--Author: Kong Chek Fung-->
<!--Date: 31 March 2022-->
<!--Validated: OK 31 March 2022-->   

<head>
    <title>Checkout Page</title>
    <meta charset="utf-8">
    <meta charset="author" content="Kong Chek Fung">
    <meta charset="desciption" content="Checkout Page">
    <meta charset="keyword" content="This is the checkout page for Online Catering System">
    <link rel="stylesheet" href="stylekong.css"/> 
</head>

<body>


<?php
    if(!empty($_POST['field'])) die();

    session_start();

    $variable1=rand(1,10);
	$variable2=rand(1,10);

    $operators=array("+","-","*");
	$operator=rand(0, count($operators)-1);
	$operator=$operators[$operator];

    $code=0;
	switch($operator){
		case "+":
		$code=$variable1+$variable2;
		break;
		case "-";
		$code=$variable1-$variable2;
		break;
		case "*":
		$code= $variable1 * $variable2;
		break;
	}
	
	$_SESSION["answer"]=$code;

    ?>

    <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     

     $conn = @mysqli_connect($servername, $username, $password);

     $sql = "CREATE DATABASE IF NOT EXISTS chekoutpagedb";

     mysqli_query($conn, $sql);
     mysqli_close($conn)
    ?>


    <?php
        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "chekoutpagedb";
        

        $conn = @mysqli_connect($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE IF NOT EXISTS checkoutlisting(
            id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			address VARCHAR(255) NOT NULL,
            phonenum INT(11) NOT NULL,
            state VARCHAR(20) NOT NULL,
            postcode INT(5) NOT NULL,
			street VARCHAR(40) NOT NULL,
			time VARCHAR(20) NOT NULL,
			choose_address VARCHAR(30)
            )";

            mysqli_query($conn, $sql);
            mysqli_close($conn)


    ?>



    <header>
        <div class="logo_word">
        <img src="images/gourmet.jpg" alt="logo" class="online_logo">
        <h1>Checkout</h1>
        </div>
    </header>



<article>
<form method='POST' action='Checkout_process.php' >
<div class="picture_bg">
<address>
<div class ="address_word">
Kong Chek Fung | (+60) 17-8861 0154<br>
No.68, Jalan Tun Abang Haji Openg,<br>
93000 Kuching, Sarawak 
<div class ="address_sign">
<p><a href="Address Selection.html">></a></p>
</div>
</div>
</address>

<hr></hr>

<h2>Pinocone Catering Company</h2>
<?php
     $itemimg = $_POST['Item_Img'];
     $itemname = $_POST['Item_Name'];
     $price = $_POST['Price'];
     $quantity = $_POST['Quantity'];
    $subtotal = $_POST['Subtotal'];
    $total = 0;
    
     if(isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $key => $value)
        {
            $count = count($_SESSION['cart']);
            $value['Subtotal'] = $value['Price'] * $value['Quantity'];

            echo"<a target='_blank' href='../shoppingcart/$value[Item_Img]'>
            <div class='food_word'>
            <img class='thumbnails' src='../shoppingcart/$value[Item_Img]' alt='food photo'></a>
            <h3>$value[Item_Name]<br>
            <br>
            RM $value[Subtotal]<br>
            <br>
            Remark: -
            </h3>
            </div>";
            
            $total += $value['Subtotal'];
        }

        
    }
    $fortotal = number_format($total, 2);


?>


<div class="border_shipping">
<div class="option">
<label for="Delivery Time">Delivery Time</label>
<hr></hr>
<?php include('../Leonard/calculatetimendate.php')?>
</div>
</div>
<br>
<div class="container1">
    <p>Message:
    <br><br>
    <input type="text1" id="Message" name="Message" placeholder="Please leave a message... ">
    </p>
    
    <hr></hr>
    <div class="order_text">
    <p>Total Order (<?php echo $count?> items): 
    <h5>RM<?php echo $fortotal?></h5>
    </p>
    </div>

    </div>

    <div class="container2">
    <p>Payment Option:</p>
    
    <div class="payment_method"> 
        <select name="payment" id="payment">
            <option selected disabled hidden value="">Select a payment method</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
            <option value="Credit Card">Credit Card</option>
        </select>
    </div>
    </div>
    
    <div class="container3">
    <div class="merchandise">
    <p>Merchandise Subtotal:
    <br>
    Shipping Subtotal:
    <br>
    Total Payment:
    <h6>RM<?php echo$fortotal?>
    <br>
    RM<?php $shipfee = number_format(10, 2);
    echo $shipfee?>
    <br>RM<?php
    $realtotal = $fortotal + $shipfee;
    echo number_format($realtotal, 2);
    ?>
    </h6> 
    </p>
    </div>

    </div> 
    
    <button class="btn_checkout">Checkout</button>
</div>
</form>
</article>

<footer>
    <div>
        <ul>
            <li><a href="#">privacy policy</a></li>
            <li>|</li>
            <li><a href="#">terms & conditions</a></li>
            <li>|</li>
            <li><a href="acknowledgement.html">acknowledgement</a></li>
            <li>|</li>
            <li><a href="disclaimer.html">disclaimer</a></li>
        </ul>
    </div>
    <div id="copyright">
        &copy; OCS 2022 | page developed by Kong Chek Fung | last updated 31/3/2022
    </div>

</footer>

<script src='../Leonard/calculatetime.js'></script>
</body>
</html>