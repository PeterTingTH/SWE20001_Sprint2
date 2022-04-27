<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Admin" />
    <meta name="description" content="Admin" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Admin - Home</title>
</head>

<body>
    <?php include 'adminNav.php';?>
    <?php 
        if (!isset($_SESSION['adminid'])){
            header("location: index.php");
            exit();
        }
    ?>

    
    
</body>

</html>