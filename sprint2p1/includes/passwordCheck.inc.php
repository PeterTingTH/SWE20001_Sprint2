<?php
session_start();

if (isset($_SESSION["custid"])){
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $pwd = $_POST['cust_password'];
    $loggedID = $_SESSION["custid"];
    $custExist = custExist($conn,$loggedID,"id");
    $correctpwd = $custExist["custPassword"];
    $email = $custExist["custEmail"];

    $pwdOK = true;
    $errormsg = "";
} else {
    header("location: ../index.php");
    exit();
}

// Password checking
if (emptyInput($pwd) == true){
    $pwdOK = false;
    $errormsg = "Password cannot be blank";
}
if (pwdMatch($pwd, $correctpwd) == false){
    $pwdOK = false;
    if ($errormsg == ""){
        $errormsg = "Incorrect password";
    }
}

if (isset($_POST['editAccPermission'])){
    if ($pwdOK){
        echo "
        <form action=\"../editAccount.php\" method=\"post\" name=\"proceedEditAcc\">
        <input type=\"submit\" name=\"proceedEditAccForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    } else {
        echo "
        <form action=\"../editPermission.php\" method=\"post\" name=\"promptPasswordAgain\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">
        <input type=\"submit\" name=\"backEditPermissionForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }

} else if (isset($_POST['deleteAccPermission'])){
    if ($pwdOK){
        sendDeleteAcc($conn,$email);
    } else {
        echo "
        <form action=\"../deleteAccConfirmation.php\" method=\"post\" name=\"promptPasswordAgain\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">
        <input type=\"submit\" name=\"backDeleteAccForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }

} else if (isset($_POST['cancelMembershipPermission'])) {
    if ($pwdOK){
        $custExist = custExist($conn,$loggedID,"id");
        $payID = $custExist["membershipPayID"];
        cancelMembership($conn, $payID);
    } else {
        echo "
        <form action=\"../cancelMembershipConfirmation.php\" method=\"post\" name=\"promptPasswordAgain\">
        <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">
        <input type=\"submit\" name=\"backCancelMembershipForm\">
        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }
    
} else {
    header("location: ../index.php");
    exit();
}