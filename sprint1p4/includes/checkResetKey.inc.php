<?php
session_start();

if (isset($_GET['passResetKey'])){

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $passResetKey = $_GET['passResetKey'];

    if (passResetKeyExist($conn, $passResetKey) == false){
        header("location: ../forgetPass.php?error=invalid");
        exit();
    } else {
        $passK = passResetKeyExist($conn, $passResetKey);
        $linkExpireT = $passK["passResetExpires"];
        if (checkLinkExpire($conn, $linkExpireT)){
            header("location: ../forgetPass.php?error=expire");
            exit();
        } else {
            if (isset($_GET['delete'])){
                $requestExist = passResetKeyExist($conn, $passResetKey);
                $emailRequest = $requestExist["passResetEmail"];
                removePassResetKey($conn,$emailRequest);
                header("location: ../forgetPass.php?error=cancelled");
                exit();
            } else {
                echo "
                <form action=\"../resetPass.php\" method=\"post\" name=\"prepareResetPass\">
                <input name=\"passResetKey\" type=\"hidden\" value=\"$passResetKey\">
                <input type=\"submit\" name=\"resetPass\">
                </form>
    
                <script>
                document.querySelector(\"input[type='submit']\").click();
                </script>
                ";
            }
        }
    }

} else {
    header("location: ../forgetPass.php");
    exit();
}