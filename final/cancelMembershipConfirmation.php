<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Cancel Membership" />
    <meta name="description" content="Cancel Membership" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Cancel Membership Confirmation</title>
</head>

<body id="cancel_membership_confirmation">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/passwordCheck.inc.php" method="post">
                    <h2>Cancel Membership</h2>
                    <p class='error_msg'>Cancelling membership is not refundable and reversable once done.</p>
                    <?php
                        if(!isset($_SESSION['custid'])){
                            header("location: index.php");
                            exit();
                        }
                        if (isset($_POST["backCancelMembershipForm"])){
                            $prevErrorMsg = $_POST["reverseErrorMsg"];
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\" class=\"error_section\"/>";
                            echo "<p class='error_msg'>$prevErrorMsg</p>";
                        } else {
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\"/>";
                        }
                    ?>
                    <button type="submit" name="cancelMembershipPermission">Cancel</button>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            if ($_GET["error"] == "send"){
                                echo "<p class='error_msg'>Delete account confirmation email has being sent.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>