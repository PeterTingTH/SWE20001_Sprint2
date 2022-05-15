<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Reset Password" />
    <meta name="description" content="Reset Password" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Reset Password</title>
</head>

<body id="reset_pass">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/resetPass.inc.php" method="post">
                    <h2>Reset Password</h2>
                    <?php
                        if (isset($_POST["resetPass"])){
                            $passResetKey = $_POST["passResetKey"];

                            echo "<input type=\"hidden\" name=\"reset_pass_key\" value=\"$passResetKey\"/>";                      
                            echo "<input type=\"password\" name=\"reset_password\" placeholder=\"New Password\"/>";
                            echo "<input type=\"password\" name=\"reset_password_repeat\" placeholder=\"Repeat New Password\"/>";                 

                        } else if (isset($_POST["backResetPassForm"])){
                            $passResetKey = $_POST["reversePassResetKey"];
                            $prevErrorSection = $_POST["reverseErrorSection"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            $prevPassStatus = $_POST["reversePassStatus"];
                            $prevPassRepeatStatus = $_POST["reversePassRepeatStatus"];
                            
                            echo "<input type=\"hidden\" name=\"reset_pass_key\" value=\"$passResetKey\"/>";

                            if ($prevPassStatus == 'true'){
                                echo "<input type=\"password\" name=\"reset_password\" placeholder=\"New Password\"/>";
                            } else {
                                echo "<input type=\"password\" name=\"reset_password\" placeholder=\"New Password\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Password"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassRepeatStatus == 'true'){
                                echo "<input type=\"password\" name=\"reset_password_repeat\" placeholder=\"Repeat New Password\" />";
                            } else {
                                echo "<input type=\"password\" name=\"reset_password_repeat\" placeholder=\"Repeat New Password\" class=\"error_section\"/>";
                                if ($prevErrorSection == "PasswordRepeat"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }                      
                        } else {
                            header("location: index.php");
                            exit();
                        }
                    ?>
                    <button type="submit" name="resetPass">Reset</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>