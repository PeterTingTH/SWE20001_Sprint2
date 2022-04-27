<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Login" />
    <meta name="description" content="Login" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Login</title>
</head>

<body id="login_page">
    <?php include 'navigation.php';?>

    <div class="form_body">
        <div class="container">
            <div class="form-container">
                <form action="includes/login.inc.php" method="post">
                    <h2>Login</h2>
                    <?php
                        if (isset($_POST["backLoginForm"])){

                            $prevEmail = $_POST["reverseEmail"];
                            $prevErrorSection = $_POST["reverseErrorSection"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            $prevEmailStatus = $_POST["reverseEmailStatus"];
                            $prevPassStatus = $_POST["reversePassStatus"];

                            if ($prevEmailStatus == 'true'){
                                echo "<input type=\"text\" name=\"login_email\" placeholder=\"Email\" value=\"$prevEmail\" />";
                            } else {
                                echo "<input type=\"text\" name=\"login_email\" placeholder=\"Email\" value=\"$prevEmail\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Email"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                            if ($prevPassStatus == 'true'){
                                echo "<input type=\"password\" name=\"login_password\" placeholder=\"Password\" />";
                            } else {
                                echo "<input type=\"password\" name=\"login_password\" placeholder=\"Password\" class=\"error_section\"/>";
                                if ($prevErrorSection == "Password"){
                                    echo "<p class='error_msg'>$prevErrorMsg</p>";
                                }
                            }
                        } else {
                            echo "<input type=\"text\" name=\"login_email\" placeholder=\"Email\" />";
                            echo "<input type=\"password\" name=\"login_password\" placeholder=\"Password\" />";
                        }
                    ?>
                    <button type="submit" name="login">Login</button>
                    <a href="forgetPass.php" class='forget_pass'>Forget Password</a>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            if ($_GET["error"] == "verified"){
                                echo "<p class='error_msg'>Account verified! You may now login.</p>";
                            }
                            if ($_GET["error"] == "already_verified"){
                                echo "<p class='error_msg'>Account has already being verified.</p>";
                            }
                            if ($_GET["error"] == "not_verified"){
                                echo "<p class='error_msg'>Account has not being verified.</p>";
                                echo "<p class='error_msg'>Haven't received the email? Click <a href=\"resendVKey.php\">here</a> to resend.</p>";
                            }
                            if ($_GET["error"] == "delete_unactivated"){
                                echo "<p class='error_msg'>Account has being removed.</p>";
                            }
                            if ($_GET["error"] == "invalid"){
                                echo "<p class='error_msg'>Invalid link.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay-panel">
                    <h1>Welcome Back!</h1>
                    <p>Didn't have an account? Click here to sign yourself up!</p>
                    <a href="signup.php" class="switch_login_signup">Sign Up</a>
                </div>
            </div> 
        </div>
    </div>
</body>

</html>