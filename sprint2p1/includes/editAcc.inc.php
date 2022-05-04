<?php
session_start();

if (isset($_POST["editAcc"])){

    $editProfImgOption = $_POST["edit_profImgOption"];
    $editProfImg = $_FILES["edit_profImg"];
    $editName = $_POST["edit_name"];
    $editPhone = $_POST["edit_phone"];
    $editPwd = $_POST["edit_password"];
    $editPwdRepeat = $_POST["edit_password_repeat"];

    $editProfImgOk = true;
    $editNameOK = true;
    $editPhoneOK = true;
    $editPwdOK = true;
    $editPwdRepeatOK = true;
    $errorSection = "";
    $errormsg = "";

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loggedID = $_SESSION['custid'];
    $custExist = custExist($conn,$loggedID,"id");

    // Profile Img Checking
    $editProfImgName = $editProfImg['name'];
    $editProfImgTmpName = $editProfImg['tmp_name'];
    $editProfImgSize = $editProfImg['size'];
    $editProfImgError = $editProfImg['error'];
    $editProfImgType = $editProfImg['type'];

    $editProfImgExt = explode('.',$editProfImgName);
    $editProfImgActualExt = strtolower(end($editProfImgExt));
    $allowed = array('jpg','jpeg','png','pdf');

    if ($editProfImgOption == "IgnoreProfImg" || $editProfImgOption == "RemoveProfImg"){
        $editProfImgOk = true;
    } else {
        if(in_array($editProfImgActualExt,$allowed)){
            if($editProfImgError === 0){
                if($editProfImgSize > 1000000){
                    $editProfImgOk = false;
                    $errorSection = "ProfImg";
                    $errormsg = "File too big";
                }
            } else {
                $editProfImgOk = false;
                $errorSection = "ProfImg";
                $errormsg = "Error uploading file";
            }
        } else {
            $editProfImgOk = false;
            $errorSection = "ProfImg";
            $errormsg = "Only .jpg, .jpeg, .png and .pdf are acceptable";
        }
    }
    // Name checking
    if (emptyInput($editName) == true){
        $editNameOK = false;
        if ($errormsg == ""){
            $errorSection = "Name";
            $errormsg = "Name cannot be blank";
        }
    }
    if (invalidName($editName) == true){
        $editNameOK = false;
        if ($errormsg == ""){
            $errorSection = "Name";
            $errormsg = "Invalid Name";
        }
    }
    // Phone checking
    if (emptyInput($editPhone) == true){
        $editPhoneOK = false;
        if ($errormsg == ""){
            $errorSection = "Phone";
            $errormsg = "Phone Number cannot be blank";
        }
    }
    if (invalidPhone($editPhone) == true){
        $editPhoneOK = false;
        if ($errormsg == ""){
            $errorSection = "Phone";
            $errormsg = "Invalid Phone Number";
        }
    }
    // Password checking
    if (emptyInput($editPwd) == true){
        $editPwdOK = false;
        $errorSection = "Password";
        $errormsg = "Password cannot be blank";
    }
    if (weakPassword($editPwd) == true){
        $editPwdOK = false;
        if ($errormsg == ""){
            $errorSection = "Password";
            $errormsg = "Password should be at least 8 characters in length and should include at least one upper case letter and one number";
        }
    }
    // Repeat Pasaword checking
    if (emptyInput($editPwdRepeat) == true){
        $editPwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Repeat your password";
        }
    }
    if ($editPwdOK == false){
        $editPwdRepeatOK = false;
    }
    if (pwdMatch($editPwd, $editPwdRepeat) == false){
        $editPwdRepeatOK = false;
        if ($errormsg == ""){
            $errorSection = "PasswordRepeat";
            $errormsg = "Password does not match";
        }
    }

    if ($editProfImgOk && $editNameOK && $editPhoneOK && $editPwdOK && $editPwdRepeatOK){
        editAccount($conn,$loggedID,$editName,$editPhone,$editPwd);
        if($editProfImgOption == "UpdateProfImg"){
            removeCustProfilePic($loggedID);
            $editProfImgNewName = "profile".$loggedID.".".$editProfImgActualExt;
            $profileImgDestination = '../uploads/profileImg/'.$editProfImgNewName;
            move_uploaded_file($editProfImgTmpName,$profileImgDestination);
            $query = "UPDATE custdata SET custProfilePicStatus = 1 WHERE custID = '$loggedID';";
            $result = mysqli_query($conn,$query);
        } 
        if($editProfImgOption == "RemoveProfImg"){
            removeCustProfilePic($loggedID);
            $query = "UPDATE custdata SET custProfilePicStatus = 0 WHERE custID = '$loggedID';";
            $result = mysqli_query($conn,$query);
        } 
        mysqli_close($conn);
        header("location: ../profile.php");
        exit();
    } else {
        $converted_editProfImgOk = $editProfImgOk ? 'true' : 'false';
        $converted_editNameOK = $editNameOK ? 'true' : 'false';
        $converted_editPhoneOK = $editPhoneOK ? 'true' : 'false';
        $converted_editPwdOK = $editPwdOK ? 'true' : 'false';
        $converted_editPwdRepeatOK = $editPwdRepeatOK ? 'true' : 'false';

        echo "
        <form action=\"../editAccount.php\" method=\"post\" name=\"reverseEditAcc\">
            <input name=\"reverseProfImgOption\" type=\"hidden\" value=\"$editProfImgOption\">
            <input name=\"reverseName\" type=\"hidden\" value=\"$editName\">
            <input name=\"reversePhone\" type=\"hidden\" value=\"$editPhone\">
            <input name=\"reversePassword\" type=\"hidden\" value=\"$editPwd\">
            <input name=\"reversePasswordRepeat\" type=\"hidden\" value=\"$editPwdRepeat\">
            <input name=\"reverseErrorSection\" type=\"hidden\" value=\"$errorSection\">
            <input name=\"reverseErrorMsg\" type=\"hidden\" value=\"$errormsg\">

            <input name=\"reverseProfImgStatus\" type=\"hidden\" value=\"$converted_editProfImgOk\">
            <input name=\"reverseNameStatus\" type=\"hidden\" value=\"$converted_editNameOK\">
            <input name=\"reversePhoneStatus\" type=\"hidden\" value=\"$converted_editPhoneOK\">
            <input name=\"reversePassStatus\" type=\"hidden\" value=\"$converted_editPwdOK\">
            <input name=\"reversePassRepeatStatus\" type=\"hidden\" value=\"$converted_editPwdRepeatOK\">
            <input type=\"submit\" name=\"backEditAccForm\">

        </form>

        <script>
        document.querySelector(\"input[type='submit']\").click();
        </script>
        ";
        mysqli_close($conn);
    }

} else if (isset($_POST["cancelEdit"])){
    header("location: ../profile.php");
    exit();
} else {
    header("location: ../index.php");
    exit();
}