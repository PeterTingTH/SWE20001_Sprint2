<!DOCTYPE html>
<html lang="en">
<!--Decription: Add New Address page-->
<!--Author: Kong Chek Fung-->
<!--Date: 5 April 2022-->
<!--Validated: OK 5 April 2022-->   

<head>
    <title>New Address</title>
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

     $sql = "CREATE DATABASE newaddressdb";

     mysqli_query($conn, $sql);
     mysqli_close($conn)
    ?>


    <?php
        $servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "newaddressdb";
        

        $conn = @mysqli_connect($servername, $username, $password, $dbname);

        $sql = "CREATE TABLE addressdetails(
            id INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(25) NOT NULL,
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
        <h1>New Address</h1>
    </header>

    <article>
        <form method='POST' action='Address_process.php' >
        <div class="edit_address">
            <div class="container">
                <label for="cname">Contact</label>
                <input type="text" id="name" name="name" placeholder="Write down your name">
                <input type="text" id="phone" name="phone" placeholder="Write down your phone number">
    
                <label for="address">Address</label>
                <input type="text" id="state" name="state" placeholder="Write down your state">
                <input type="text" id="postcode" name="postcode" placeholder="Write down your postcode">
                <input type="text" id="street" name="street" placeholder="Write down your street">
    
            
                <label for="setting">Setting</label>
                <p>Label as: 
                <select name="time" id="time">
                    <option value=""></option>
                    <option value="Work">Work</option>
                    <option value="Home">Home</option>
                </select>
                </p>
                <?php
                $check = isset($_POST['check']) ? 1 : 0;
                
                ?>
                <p>Set as Default Address:
                <label class="switch">
                <input type="hidden" name='check' value='No Default Address'> 
                    <input type="checkbox" name='check' value='Default Address'> 
                    <span class="slider"></span>
                </label>
                </p>
    
                
                <div class="button1">
                <button >SUBMIT</button>
                </div>
    
                <div class="backbtn">
                <button><a href="Address Selection.html">BACK</a></button>
                </div>
            </div>
        </div>
        </form>
    </article>


</body>
</html>