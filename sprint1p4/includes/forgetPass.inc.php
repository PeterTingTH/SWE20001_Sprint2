<?php

if (isset($_POST["sendResetKey"])){

    $email = $_POST["reset_email"];

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
        sendResetPassword($conn,$email);
    } else {
        echo "
        <form action=\"../forgetPass.php\" method=\"post\" name=\"reverseForgetPass\">
        <input name=\"reverseEmail\" type=\"hidden\" value=\"$email\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">
        <input type=\"submit\" name=\"backForgetPassForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
    }
} else {
    header("location: ../forgetPass.php");
    exit();
}