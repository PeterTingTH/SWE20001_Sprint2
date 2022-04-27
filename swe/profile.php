<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Profile" />
    <meta name="description" content="Profile" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Profile</title>
</head>

<body>
    <?php include 'navigation.php';?>

    <div class="profile_background">
    </div>
    <div class="profile_information">
        <img src="default.jpg" alt="" class="profile_pic">
        <?php echo "<h1>" . $_SESSION['custname'] . "</h1>"?>
        <?php echo "<p>Registered Email: " . $_SESSION['custemail'] . "</h1>"?>

        <div>
            <a href="">Edit account</a>
            <a href="">Delete account</a>
        </div>
    </div>



    
</body>

</html>