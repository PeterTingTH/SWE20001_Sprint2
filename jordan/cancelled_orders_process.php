<?php

  $serverName = "localhost";
  $dBUsername = "root";
  $dBPassword = "";
  $dBName = "total_orders";

  $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli ="DELETE FROM pending WHERE id=$id";
    $result = mysqli_query($conn,$mysqli) or die ( mysqli_error($conn));

    header("Location: cancelled_orders.php");
  }

  if (isset($_GET['reconfirm'])){
    $id = $_GET['reconfirm'];
    
    $mysqli = "UPDATE cancelled SET status='Confirmed' WHERE id = $id";
    $mysqli1 = "INSERT INTO total SELECT * FROM  cancelled WHERE id =$id" ;// copy one table to another
    $mysqli2 = "DELETE FROM cancelled WHERE id=$id";

    $result = mysqli_query($conn,$mysqli) or die ( mysqli_error($conn));
    $result1 = mysqli_query($conn,$mysqli1) or die ( mysqli_error($conn));
    $result2 = mysqli_query($conn,$mysqli2) or die ( mysqli_error($conn));

    header("Location: total_orders.php");
  }

?>