<?php
// connect to database
  /*$conn = mysqli_connect('localhost', 'root', '','orderdb');

  // check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }*/
function checkConnection(){
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
}

function createDatabase($conn){
    $sql = "CREATE DATABASE IF NOT EXISTS orderdb";
    mysqli_query($conn, $sql);
}

function createTablePendingOrders($conn){
  $sql = "CREATE TABLE IF NOT EXISTS pendingorders (
    order_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    quantity INT(11) NOT NULL,
    productId INT(11) NOT NULL,
    productName VARCHAR(255) NOT NULL,
    totalPrice FLOAT NULL,
    deliveryAddress VARCHAR(255) NOT NULL,
    deliveryTime DATETIME NULL DEFAULT CURRENT_TIMESTAMP
  )";
  mysqli_query($conn, $sql);
}

function createTableCancelledOrders($conn){
  $sql = "CREATE TABLE IF NOT EXISTS cancelledorders (
    order_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    quantity INT(11) NOT NULL,
    productId INT(11) NOT NULL,
    productName VARCHAR(255) NOT NULL,
    totalPrice FLOAT NULL,
    deliveryAddress VARCHAR(255) NOT NULL,
    deliveryTime DATETIME NULL DEFAULT CURRENT_TIMESTAMP
  )";
  mysqli_query($conn, $sql);
}

function createTableSearch($conn){
  $sql = "CREATE TABLE IF NOT EXISTS search (
    search_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    s_title VARCHAR(255) NOT NULL,
    s_Desc VARCHAR(255) NOT NULL,
    s_price FLOAT NOT NULL,
  )";
  mysqli_query($conn, $sql);
}

function createTableOrderStatus($conn){
  $sql = " CREATE TABLE IF NOT EXISTS orderstatus(
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    order_id INT(11) UNSIGNED NOT NULL,
    orderStatus VARCHAR(255),
    FOREIGN KEY(order_id) REFERENCES (pendingorders) ON DELETE CASCADE
  )";

  mysqli_query($conn, $sql);
}

$conn = mysqli_connect('localhost', 'root', '','orderdb');
checkConnection();
createDatabase($conn);

createTablePendingOrders($conn);
createTableCancelledOrders($conn);
createTableSearch($conn);
createTableOrderStatus($conn);

?>