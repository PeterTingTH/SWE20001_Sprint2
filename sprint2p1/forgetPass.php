<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Forget Password" />
    <meta name="description" content="Forget Password" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Forget Password</title>
</head>

<body id="forget_password">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/forgetPass.inc.php" method="post">
                    <h2>Forget Password</h2>
                    <?php
                        if (isset($_POST["backForgetPassForm"])){
                            $prevEmail = $_POST["reverseEmail"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            echo "<input type=\"text\" name=\"reset_email\" placeholder=\"Email\" value=\"$prevEmail\" class=\"error_section\"/>";
                            echo "<p class='error_msg'>$prevErrorMsg</p>";
                        } else {
                            echo "<input type=\"text\" name=\"reset_email\" placeholder=\"Email\" />";                        
                        }
                    ?>
                    <button type="submit" name="sendResetKey">Send</button>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            if ($_GET["error"] == "send"){
                                echo "<p class='error_msg'>Password reset email has being sent.</p>";
                            }
                            if ($_GET["error"] == "not_verified"){
                                echo "<p class='error_msg'>Account has not being verified.</p>";
                                echo "<p class='error_msg'>Haven't received the email? Click <a href=\"resendVKey.php\">here</a> to resend.</p>";
                            }
                            if ($_GET["error"] == "cancelled"){
                                echo "<p class='error_msg'>Request cancelled.</p>";
                            }
                            if ($_GET["error"] == "reset"){
                                echo "<p class='error_msg'>Password reset.</p>";
                            }
                            if ($_GET["error"] == "invalid"){
                                echo "<p class='error_msg'>Invalid link.</p>";
                            }
                            if ($_GET["error"] == "expire"){
                                echo "<p class='error_msg'>Link expired. Send another request.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
