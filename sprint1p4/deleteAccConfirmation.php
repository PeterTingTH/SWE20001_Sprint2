<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Delete Account" />
    <meta name="description" content="Delete Account" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Delete Confirmation</title>
</head>

<body id="delete_acc_confirmation">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/passwordCheck.inc.php" method="post">
                    <h2>Delete Account</h2>
                    <p class='error_msg'>Deleting will erase your account from the database which will not be recoverable.</p>
                    <?php
                        if(!isset($_SESSION['custid'])){
                            header("location: index.php");
                            exit();
                        }
                        if (isset($_POST["backDeleteAccForm"])){
                            $prevErrorMsg = $_POST["reverseErrorMsg"];
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\" class=\"error_section\"/>";
                            echo "<p class='error_msg'>$prevErrorMsg</p>";
                        } else {
                            echo "<input type=\"password\" name=\"cust_password\" placeholder=\"Password\"/>";
                        }
                    ?>
                    <button type="submit" name="deleteAccPermission">Delete</button>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            if ($_GET["error"] == "send"){
                                echo "<p class='error_msg'>Delete account confirmation email has being sent.</p>";
                            }
                            if ($_GET["error"] == "invalid"){
                                echo "<p class='error_msg'>Invalid link.</p>";
                            }
                            if ($_GET["error"] == "expire"){
                                echo "<p class='error_msg'>Link expired. Send another request.</p>";
                            }
                            if ($_GET["error"] == "cancelled"){
                                echo "<p class='error_msg'>Request cancelled.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>