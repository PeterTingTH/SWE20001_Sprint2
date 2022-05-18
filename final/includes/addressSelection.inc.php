<?php
session_start();

    if(!empty($_POST['field'])) die();

    session_start();
    require_once('Edit.php');
    require_once('NewAddress.php');

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
