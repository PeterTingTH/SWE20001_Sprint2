<?php

if (isset($_POST["resetPass"])){

    $passResetKey = $_POST["reset_pass_key"];
    $newPwd = $_POST["reset_password"];
    $newPwdRepeat = $_POST["reset_password_repeat"];;

    $newPwdOK = true;
    $newPwdRepeatOK = true;
    $errorSection = "";
    $errormsg = "";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $passK = passResetKeyExist($conn, $passResetKey);
    $linkExpireT = $passK["passResetExpires"];

    if(checkLinkExpire($linkExpireT)){
        header("location: ../forgetPass.php?error=expire");
        exit();
    }

    // Password checking
    if (emptyInput($newPwd) == true){
        $newPwdOK = false;
        $errorSection = "Password";
        $errormsg = "Password cannot be blank";
    }
    if (weakPassword($newPwd) == true){
        $newPwdOK = false;
        if ($errormsg == ""){
            $errorSection = "Password";
            $errormsg = "Password should be at least 8 characters in length and should include at least one upper case letter and one number";
        }
    }
    // Repeat Pasaword checking
    if (emptyInput($newPwdRepeat) == true){
        $newPwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Repeat your password";
        }
    }
    if ($newPwdOK == false){
        $newPwdRepeatOK = false;
    }
    if (pwdMatch($newPwd, $newPwdRepeat) == false){
        $newPwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Password does not match";
        }
    }

    if ($newPwdOK && $newPwdRepeatOK){
        resetPassword($conn,$newPwd,$passResetKey);
    } else {
        $converted_newPwdOK = $newPwdOK ? 'true' : 'false';
        $converted_newPwdRepeatOK = $newPwdRepeatOK ? 'true' : 'false';

        echo "
        <form action=\"../resetPass.php\" method=\"post\" name=\"reverseResetPass\">
        <input name=\"reversePassResetKey\" type=\"hidden\" value=\"$passResetKey\">
        <input name=\"reverseErrorSection\" type=\"hidden\" value=\"$errorSection\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">

        <input name=\"reversePassStatus\" type=\"hidden\" value=\"$converted_newPwdOK\">
        <input name=\"reversePassRepeatStatus\" type=\"hidden\" value=\"$converted_newPwdRepeatOK\">
        <input type=\"submit\" name=\"backResetPassForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }
} else {
    header("location: ../forgetPass.php");
    exit();
}