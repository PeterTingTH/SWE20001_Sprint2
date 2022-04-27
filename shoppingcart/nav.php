<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="css/navstyle.css">
</head>
<body>
    <?php
    $count=0;
    if(isset($_SESSION['cart']))
    {
        $count=count($_SESSION['cart']);
    }
    ?>
    <div >
    <a href='index.php' class='nav'>Home</a>
    <a href="mycart.php" class='button'>My Cart(<?php echo $count; ?>)</a>
    </div>
</body>
</html>