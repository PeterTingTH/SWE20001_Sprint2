<!DOCTYPE html>
<html lang="en">
<!--Decription: Edit Address page-->
<!--Author: Kong Chek Fung-->
<!--Date: 5 April 2022-->
<!--Validated: OK 5 April 2022-->   

<head>
    <title>Edit Address</title>
    <meta charset="utf-8">
    <meta charset="author" content="Kong Chek Fung">
    <meta charset="desciption" content="Checkout Page">
    <meta charset="keyword" content="This is the display address for Online Catering System">
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
	$dbname = "editaddressdb";
	$error = false;
		
	$errormsg = "";
	$msg = "";

    $conn = @mysqli_connect($servername, $username, $password, $dbname);
   
        $name = $_POST['name'];
        $phone = $_POST['phone'];
		$state = $_POST['state'];
		$postcode = $_POST['postcode'];
        $street = $_POST['street'];
		$time = $_POST['time'];
        $switch = $_POST['check'];
		//$switch_checkbox = @implode(",",$switch);
	
        if (!empty($name)){
			$name = sanitiseInput($name);
			if (!preg_match("/[a-zA-Z]+$/",$name)){
				$errormsg .= "<p>Error! Name, only letters and spaces allowed.</p>";
				$error = true;
			} elseif (strlen($name) > 25){
				$errormsg .= "<p>Error! Name must have less than 25 characters.</p>";
				$error = true;
			}
		} else {
			$errormsg .= "<p>Error! Name is empty</p>";
			$error = true;
		}

        if (!empty($phone)){
			$phone = sanitiseInput($phone);
			if (!preg_match("/[0-9+$]/",$phone)){
				$errormsg .= "<p>Error! Phone number should only contain digits.</p>";
				$error = true;
			} elseif (strlen($phone) > 10){
				$errormsg .= "<p>Error! Phone number should be 10 digits or less.</p>";
				$error = true;
			}
		} else {
			$errormsg .= "<p>Error! Phone number should not be empty</p>";
			$error = true;
		}

        if (!empty($state)){
			$state = sanitiseInput($state);
			if (!preg_match("/[a-zA-z]+$/",$state)){
				$errormsg .= "<p>Error! State must not contain special characters.</p>";
				$error = true;
			} elseif (strlen($state) > 20){
				$errormsg .= "<p>Error! State must be less than 40 characters.</p>";
				$error = true;
			}
		} else {
			$errormsg .= "<p>Error! State is empty</p>";
			$error = true;
		}

        if (!empty($postcode)){
			$postcode = sanitiseInput($postcode);
			if (is_nan($postcode)){
				$errormsg .= "<p>Error! Postcode should only contain numbers.</p>";
				$error = true;
			} elseif (!preg_match("/\d+$/",$postcode)){
				$errormsg .= "<p>Error! Postcode name must not contain special characters.</p>";
				$error = true;
			} elseif ((strlen($postcode) > 5) || (strlen($postcode) < 5)){
				$errormsg .= "<p>Error! Postcode must be 5 digits</p>";
				$error = true;
			}
		} else {
			$errormsg .= "<p>Error! Postcode is empty</p>";
			$error = true;
		}

        if (!empty($street)){
			$street = sanitiseInput($street);
			if (!preg_match("/[a-zA-Z0-9\s]$/",$street)){
				$errormsg .= "<p>Error! Street name must not contain special characters.</p>";
				$error = true;
			} elseif (strlen($street) > 40){
				$errormsg .= "<p>Error! Street name must be less than 40 characters.</p>";
				$error = true;
			}
		} else {
			$errormsg .= "<p>Error! Street name is empty</p>";
			$error = true;
		}

        if (empty($time)){
			$errormsg .= "<p>Error! Please select a time</p>";
			$error = true;
		}
		//if (isset($switch))
	

        if ($error == false){
			$sql = "INSERT INTO editaddressdetails(name,phonenum,state,postcode,street,time,choose_address)
				VALUES ('$name','$phone','$state','$postcode','$street','$time','$switch')";
				mysqli_query($conn, $sql);

			$msg = "<h1> Your address has been edited! </h1>";
		} else {
			$msg = "<h1> There seems to be a few errors with record submission, please fix the errors bellow and resubmit </h1> "; 
			
		}

        function sanitiseInput($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

        mysqli_close($conn);
        ?>
        
        
        <div class="proHeading">
            <?php echo $msg; ?>
        </div>
        
        <article class="proError">
	<?php 
		if ($error == true){
			echo $errormsg; 
			
		} elseif ($error == false){
	?>		
		<table>
			<tr>
				<td colspan="2"> Submitted Data </td>
			</tr>
			
			<tr>
				<td>Name</td>
				<td><?php echo $name; ?></td>
			</tr>
			
			<tr>
				<td>Phone</td>
				<td><?php echo $phone; ?></td>
			</tr>

			<tr>
				<td>State</td>
				<td><?php echo $state; ?></td>
			</tr>

			<tr>
				<td>Postcode</td>
				<td><?php echo $postcode; ?></td>
			</tr>

			<tr>
				<td>Time</td>
				<td><?php echo $time; ?></td>
			</tr>
			
			<tr>
				<td>Address Selection:</td>
				<td><?php echo $switch; ?></td>
			</tr>
			
		</table>

	<?php
		}
	?>

</article>

</body>
</html>