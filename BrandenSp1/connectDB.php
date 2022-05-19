<?php

//Connect to database named "pineconecc"
    $conn = mysqli_connect('localhost', 'root', '', 'pineconecc') or die ("Connection error");
    
    if(!$conn){
        echo'connection error: ' . mysqli_connect_error();
    }
?>