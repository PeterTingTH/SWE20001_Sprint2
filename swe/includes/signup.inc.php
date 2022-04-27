<?php

if (isset($_POST["signup"])){
    $name = $_POST["signup_name"];
    $email = $_POST["signup_email"];
    $pwd = $_POST["signup_password"];
    $pwdRepeat = $_POST["signup_password_repeat"];

    $nameOK = true;
    $emailOK = true;
    $pwdOK = true;
    $pwdRepeatOK = true;
    $errorSection = "";
    $errormsg = "";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Name checking
    if (emptyInput($name) == true){
        $nameOK = false;
        $errorSection = "Name";
        $errormsg = "Name cannot be blank";
    }
    if (invalidName($name) == true){
        $nameOK = false;
        if ($errormsg == ""){
            $errorSection = "Name";
            $errormsg = "Invalid Name";
        }
    }
    // Email format checking
    if (emptyInput($email) == true){
        $emailOK = false;
        if ($errormsg == ""){
            $errorSection = "Email";
            $errormsg = "Email cannot be blank";
        }
    }
    if (invalidEmail($email) == true){
        $emailOK = false;
        if ($errormsg == ""){
            $errorSection = "Email";
            $errormsg = "Invalid Email";
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
    if (weakPassword($pwd) == true){
        $pwdOK = false;
        if ($errormsg == ""){
            $errorSection = "Password";
            $errormsg = "Password should be at least 8 characters in length and should include at least one upper case letter and one number";
        }
    }
    // Repeat Pasaword checking
    if (emptyInput($pwdRepeat) == true){
        $pwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Repeat your password";
        }
    }
    if ($pwdOK == false){
        $pwdRepeatOK = false;
    }
    if (pwdMatch($pwd, $pwdRepeat) == false){
        $pwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Password does not match";
        }
    }

    // Email checking
    if (emailExist($conn, $email) !== false){
        $emailOK = false;
        if ($errormsg == ""){
            $errorSection = "Email";
            $errormsg = "Email has already being taken";
        }
    }

    if ($nameOK && $emailOK && $pwdOK && $pwdRepeatOK){
        createCustomer($conn, $name, $email, $pwd);
    } else {
        $converted_nameOK = $nameOK ? 'true' : 'false';
        $converted_emailOK = $emailOK ? 'true' : 'false';
        $converted_pwdOK = $pwdOK ? 'true' : 'false';
        $converted_pwdRepeatOK = $pwdRepeatOK ? 'true' : 'false';

        echo "
        <form action=\"../signup.php\" method=\"post\" name=\"reverseSign\">
        <input name=\"reverseName\" type=\"hidden\" value=\"$name\">
        <input name=\"reverseEmail\" type=\"hidden\" value=\"$email\">
        <input name=\"reverseErrorSection\" type=\"hidden\" value=\"$errorSection\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">

        <input name=\"reverseNameStatus\" type=\"hidden\" value=\"$converted_nameOK\">
        <input name=\"reverseEmailStatus\" type=\"hidden\" value=\"$converted_emailOK\">
        <input name=\"reversePassStatus\" type=\"hidden\" value=\"$converted_pwdOK\">
        <input name=\"reversePassRepeatStatus\" type=\"hidden\" value=\"$converted_pwdRepeatOK\">
        <input type=\"submit\" name=\"backSignUpForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>

        ";
    }

} else {
    header("location: ../signup.php");
    exit();
}