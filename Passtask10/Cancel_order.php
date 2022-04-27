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

     $sql = "CREATE DATABASE cancelorderdb";

     mysqli_query($conn, $sql);
     mysqli_close($conn)
    ?>


    <?php
        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "cancelorderdb";
        

        $conn = @mysqli_connect($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE cancelorderdetail(
            id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			img VARCHAR(25) NOT NULL,
            itemname VARCHAR(25) NOT NULL,
            price double(10,2) NOT NULL,
            comment VARCHAr(50) NOT NULL,
            )";

            mysqli_query($conn, $sql);
            mysqli_close($conn)


    ?>


   <header>
       <h1>Cancel Order</h1>
   </header>

   <article>
       <form method='POST' action='Cancel_order_process.php'>

        <div class="food_word1">

            <input type="hidden"  name='img' id='img' value="images/Food_1.jpg">
			<img src="images/Food_1.jpg" class="thumbnails1"/>

                <div class="order1">
                    <div class="itemname" id="itemname", name="itemname">Idli Dosa</div>
                    <div class="price" id="price", name="price">RM 12.70</div>
                    <div class="comment" id="comment", name="comment">Remark: -</div>
                </div>
            
        </div>
    
        <div class="cancelbtn">
            <button>Cancel Order</button>
        </div>

        </form>
   </article>

</body>
</html>