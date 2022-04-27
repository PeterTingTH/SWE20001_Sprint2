<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Home" />
    <meta name="description" content="Home" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Home</title>
</head>

<body>
    <?php include 'navigation.php';?>
    <?php
        if (isset($_SESSION['adminid'])){
            header("location: admin.php");
            exit();
        }
    ?>
    
</body>

</html>