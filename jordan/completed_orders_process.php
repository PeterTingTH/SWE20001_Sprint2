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
    $mysqli ="DELETE FROM completed WHERE id=$id";
    $result = mysqli_query($conn,$mysqli) or die ( mysqli_error($conn));

    header("Location: completed_orders.php");
  }
?>