<!DOCTYPE html>
<html lang="en">
<!--Decription: Checkout page-->
<!--Author: Kong Chek Fung-->
<!--Date: 31 March 2022-->
<!--Validated: OK 31 March 2022-->   

<head>
    <title>Cancel Order Page</title>
    <meta charset="utf-8">
    <meta charset="author" content="Kong Chek Fung">
    <meta charset="desciption" content="Checkout Page">
    <meta charset="keyword" content="This is the checkout page for Online Catering System">
    <link rel="stylesheet" href="stylekong.css"/> 
</head>

<body>
<?php

session_start();

$code=$_SESSION["answer"];
$captcha=@$_POST["answer"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cancelorderdb";
$error = false;
    
$errormsg = "";
$msg = "";

$conn = @mysqli_connect($servername, $username, $password, $dbname);

    $img = $_POST['img'];
    $itemname = $_POST['itemname'];
    $price = $_POST['price'];
    $comment = $_POST['comment'];
    
    if ($error == false){
        $sql = "INSERT INTO cancelorderdetail(img,itemname,price,comment)
            VALUES ('$img','$itemname','$price','$comment') ON DUPLICATE KEY UPDATE";
            mysqli_query($conn, $sql);

        $msg = "<h1> Your order has been cancelled! </h1>";
    } else {
        header("Location: Cancel_order_process.php");
        
    }

    if($conn){
		$query = "SELECT * FROM cancelorderdetail";
		$result = mysqli_query($conn, $query);

		if($result < $query){
			$record = mysqli_fetch_assoc($result);
		}
		

		mysqli_close($conn);
	}

    
?>
    
    <?php
	$row = mysqli_fetch_assoc($result);
	while($row){
    ?>

	<div class="Cancel_Container">
    <div class="Header">
        <h3 class="Heading">Checkout</h3>
    </div>
    <div class="Cancel_Order">
        <div class="image-box">
            <img src='<?php echo $img; ?>' style={{ height="120px" }} />
        </div>
        <div class="name">
            <h1 class="itemname"><?php echo $itemname; ?></h1>
        </div>
        <div class="prices">
            <div class="price">$<?php echo $price;?></div>
        </div>
        <div class="comment">
            <div class="comment">$<?php echo $comment;?></div>
        </div>
    </div>
	<div class="cancelbtn">
   	 <button class="button">Cancel Order</button>
    </div>

	<?php
		$row = mysqli_fetch_assoc($result);
	}
?>
</div>

</div>

</article>
</body>
</html>