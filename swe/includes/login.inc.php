<?php

if (isset($_POST["login"])){

    $email = $_POST["login_email"];
    $pwd = $_POST["login_password"];

    $emailOK = true;
    $pwdOK = true;
    $errorSection = "";
    $errormsg = "";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Email checking
    if (emptyInput($email) == true){
        $emailOK = false;
        $errorSection = "Email";
        $errormsg = "Email cannot be blank";
    }
    if (invalidEmail($email) == true){
        $emailOK = false;
        if ($errormsg == ""){
            $errorSection = "Email";
            $errormsg = "Invalid Email";
        }
    }
    if (emailExist($conn, $email) == false){
        $emailOK = false;
        if ($errormsg == ""){
            $errorSection = "Email";
            $errormsg = "Account not found";
        }
    }
    // Password checking
    if (emptyInput($pwd) == true){
        $pwdOK = false;
        if ($errormsg == ""){
            $errorSection = "Password";
            $errormsg = "Password cannot be blank";
        }
    }
    if (wrongPassword($conn, $email, $pwd) == true){
        $pwdOK = false;
        if ($errormsg == ""){
            $errorSection = "Password";
            $errormsg = "Incorrect Password";
        }
    }

    if ($emailOK && $pwdOK){
        loginUser($conn, $email);
    } else {
        $converted_emailOK = $emailOK ? 'true' : 'false';
        $converted_pwdOK = $pwdOK ? 'true' : 'false';

        echo "
        <form action=\"../login.php\" method=\"post\" name=\"reverseLogin\">
        <input name=\"reverseEmail\" type=\"hidden\" value=\"$email\">
        <input name=\"reverseErrorSection\" type=\"hidden\" value=\"$errorSection\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">

        <input name=\"reverseEmailStatus\" type=\"hidden\" value=\"$converted_emailOK\">
        <input name=\"reversePassStatus\" type=\"hidden\" value=\"$converted_pwdOK\">
        <input type=\"submit\" name=\"backLoginForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>

        ";
    }
} else {
    header("location: ../login.php");
    exit();
}