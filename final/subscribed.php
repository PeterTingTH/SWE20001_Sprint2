<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Success Subscribed" />
    <meta name="description" content="Success Subscribed" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Subscribed</title>
</head>

<body id="success_subscribed">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <div class="msg">
                    <div class="one_column_sign">
                        <img src="images/subscribed.png" alt="subscribe">
                    </div>
                    <h2>Subscribed</h2>
                    <p>Congratulations! You have successfully being a part of the Pinocone family!</p>
                    <br>
                    <p>Membership start from 
                        <?php 
                            $loggedID = $_SESSION['custid'];
                            $active = activeMemberPaymentExist($conn,$loggedID);
                            $memberStart = $active["membershipStart"];
                            $memberExp = $active["membershipExpire"];
                            echo date("Y-m-d",strtotime($memberStart)). '.';
                        ?>
                    </p>
                    <p>Membership valid till 
                        <?php 
                            echo date("Y-m-d",strtotime($memberExp)). '.';
                            mysqli_close($conn);
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>