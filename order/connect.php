<?php
// connect to database
  $con = mysqli_connect('localhost', 'root', '','orderdb');

  // check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }

?>