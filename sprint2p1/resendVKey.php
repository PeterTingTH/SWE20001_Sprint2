<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=ul, initial-scale=1.0" />
    <meta name="author" content="Peter" />
    <meta name="keywords" content="Resend Vkey" />
    <meta name="description" content="Resend Vkey" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <title>Resend Verification Key</title>
</head>

<body id="resend_key">
    <?php include 'navigation.php';?>

    <div class="form_body one_column_form">
        <div class="container">
            <div class="form-container">
                <form action="includes/resendVKey.inc.php" method="post">
                    <h2>Resend Verification Key</h2>
                    <?php
                        if (isset($_POST["backReverseVKeyForm"])){
                            $prevEmail = $_POST["reverseEmail"];
                            $prevErrorMsg = $_POST["reverseErrorMsg"];

                            echo "<input type=\"text\" name=\"resend_email\" placeholder=\"Email\" value=\"$prevEmail\" class=\"error_section\"/>";
                            echo "<p class='error_msg'>$prevErrorMsg</p>";
                        } else {
                            echo "<input type=\"text\" name=\"resend_email\" placeholder=\"Email\" />";                        
                        }
                    ?>
                    <button type="submit" name="resend">Resend</button>
                    <?php
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "stmtfailed"){
                                echo "<p class='error_msg'>Something went wrong, try again!</p>";
                            }
                            if ($_GET["error"] == "send"){
                                echo "<p class='error_msg'>New verification key has being sent.</p>";
                            }
                            if ($_GET["error"] == "already_verified"){
                                echo "<p class='error_msg'>Account has already being verified.</p>";
                            }
                        } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>

</html>