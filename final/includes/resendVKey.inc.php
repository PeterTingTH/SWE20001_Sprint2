<?php

if (isset($_POST["resend"])){

    $email = $_POST["resend_email"];

    $emailOK = true;
    $errormsg = "";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Email checking
    if (emptyInput($email) == true){
        $emailOK = false;
        $errormsg = "Email cannot be blank";
    }
    if (invalidEmail($email) == true){
        $emailOK = false;
        if ($errormsg == ""){
            $errormsg = "Invalid Email";
        }
    }
    if (custExist($conn, $email, "email") == false){
        $emailOK = false;
        if ($errormsg == ""){
            $errormsg = "Account not found";
        }
    }

    if ($emailOK){
        resendVKey($conn, $email);
    } else {
        echo "
        <form action=\"../resendVKey.php\" method=\"post\" name=\"reverseVKey\">
        <input name=\"reverseEmail\" type=\"hidden\" value=\"$email\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">
        <input type=\"submit\" name=\"backReverseVKeyForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }
} else {
    header("location: ../resendVKey.php");
    exit();
}