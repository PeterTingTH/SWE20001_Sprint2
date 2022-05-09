<!DOCTYPE html>
<html lang="en">
<!--Decription: Delivery address option page-->
<!--Author: Kong Chek Fung-->
<!--Date: 4 April 2022-->
<!--Validated: OK 4 April 2022-->   

<head>
    <title>Delivery address option</title>
    <meta charset="utf-8">
    <meta charset="author" content="Kong Chek Fung">
    <meta charset="desciption" content="Checkout Page">
    <meta charset="keyword" content="This is the display address for Online Catering System">
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

     $sql = "CREATE DATABASE IF NOT EXISTS addressSelectiondb";

     mysqli_query($conn, $sql);
     mysqli_close($conn)
    ?>

    <?php
        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "addressSelectiondb";
        

        $conn = @mysqli_connect($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE IF NOT EXISTS selectionlisting(
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
        <h1>Address Selection</h1>
    </header>

<article>
    <div class="selection_address">
        <div class="information">
        <p>Kong Chek Fung<br>(+60)17-8861 0154<br>No.68, Jalan Tun Abang Haji Openg,<br>93000 Kuching, Sarawak</p>
        <h4>[Default]</h4>
        <div class="edit">
        <p><a href="Edit.html">EDIT</a></p>
        </div>
        </div>

        <div class="information">
        <p>Kong Chek Fung<br>(+60)17-8861 0154<br>No.75, Jalan Tun Abang Haji Openg,<br>93000 Kuching, Sarawak</p>
        <div class="edit">
        <p><a href="Edit.html">EDIT</a></p>
        </div>
        </div>

        <div class="new_information">
         <p>Add a new address</p>
         <div class="plus">
        <p><a href="New Address.html">+</a></p>
         </div>  
        </div>

    </div>

</article>

</body>
</html>