<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Sign Up" />
    <meta name="description" content="Sign Up" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Sign Up</title>
</head>

<body id="sign_up_page">
    <?php include 'navigation.php';?>

    <div class="form_body">
        <div class="container">
            <div class="form-container">
                <form action="includes/signup.inc.php" method="post">
                    <h2>Sign Up</h2>
                    <?php
                        if (isset($_POST["backSignUpForm"])){

                            $prevName = $_POST["reverseName"];
                            $prevEmail = $_POST["reverseEmail"];
                            $prevPhone = $_POST["reversePhone"];
                            $prevErrorSection = $_POST["reverseErrorSection"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            $prevNameStatus = $_POST["reverseNameStatus"];
                            $prevEmailStatus = $_POST["reverseEmailStatus"];
                            $prevPhoneStatus = $_POST["reversePhoneStatus"];
                            $prevPassStatus = $_POST["reversePassStatus"];
                            $prevPassRepeatStatus = $_POST["reversePassRepeatStatus"];

                            if ($prevNameStatus == 'true'){
                                echo "<input type=\"text\" name=\"signup_name\" placeholder=\"Name\" value=\"$prevName\" />";
                            } else {
                                echo "<input type=\"text\" name=\"signup_name\" placeholder=\"Name\" value=\"$prevName\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Name"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevEmailStatus == 'true'){
                                echo "<input type=\"text\" name=\"signup_email\" placeholder=\"Email\" value=\"$prevEmail\" />";
                            } else {
                                echo "<input type=\"text\" name=\"signup_email\" placeholder=\"Email\" value=\"$prevEmail\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Email"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPhoneStatus == 'true'){
                                echo "<input type=\"text\" name=\"signup_phone\" placeholder=\"Phone Number\" value=\"$prevPhone\" />";
                            } else {
                                echo "<input type=\"text\" name=\"signup_phone\" placeholder=\"Phone Number\" value=\"$prevPhone\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Phone"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassStatus == 'true'){
                                echo "<input type=\"password\" name=\"signup_password\" placeholder=\"Password\" />";
                            } else {
                                echo "<input type=\"password\" name=\"signup_password\" placeholder=\"Password\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Password"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassRepeatStatus == 'true'){
                                echo "<input type=\"password\" name=\"signup_password_repeat\" placeholder=\"Repeat password\" />";
                            } else {
                                echo "<input type=\"password\" name=\"signup_password_repeat\" placeholder=\"Repeat password\" class=\"error_section\"/>";
                                if ($prevErrorSection == "PasswordRepeat"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                        } else {
                            echo "<input type=\"text\" name=\"signup_name\" placeholder=\"Name\" />";
                            echo "<input type=\"text\" name=\"signup_email\" placeholder=\"Email\" />";
                            echo "<input type=\"text\" name=\"signup_phone\" placeholder=\"Phone Number\" />";
                            echo "<input type=\"password\" name=\"signup_password\" placeholder=\"Password\" />";
                            echo "<input type=\"password\" name=\"signup_password_repeat\" placeholder=\"Repeat password\" />";
                        }
                    ?>
                    <button type="submit" name="signup">Sign Up</button>
                    <a href="forgetPass.php" class='forget_pass'>Forget Password</a>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            else if ($_GET["error"] == "none"){
                                echo "<p class='error_msg'>Signed up successfully! Check your email to activate your account!</p>";
                                echo "<p class='error_msg'>Haven't received the email? Click <a href=\"resendVKey.php\">here</a> to resend.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay-panel">
                    <h1>Hola, friend!</h1>
                    <p>Have an account? Click here to login!</p>
                    <a href="login.php" class="switch_login_signup">Login</a>
                </div>
            </div> 
        </div>
    </div>
</body>

</html>