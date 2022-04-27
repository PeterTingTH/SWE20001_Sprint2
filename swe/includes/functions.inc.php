<?php
function emptyInput($input){
    $result;
    if (empty($input)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidName($name){
    $result;
    if (!preg_match("/^[a-zA-Z ]*$/", $name)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function weakPassword($pwd){
    $result;
    $uppercase = preg_match('@[A-Z]@', $pwd);
    $lowercase = preg_match('@[a-z]@', $pwd);
    $number = preg_match('@[0-9]@', $pwd);
    if (!$uppercase || !$lowercase || !$number || strlen($pwd) < 8) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRepeat){
    $result;
    if ($pwd == $pwdRepeat){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emailExist($conn, $email){
    $sql = "SELECT * FROM custdata WHERE custEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        $result = false;
        return $result;
    }
}

function createCustomer($conn, $name, $email, $pwd){
    $sql = "INSERT INTO custdata (custName, custEmail, custPassword) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $email, $pwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
}

function wrongPassword($conn, $email, $pwd){
    $custExist = emailExist($conn, $email);
    $custPwd = $custExist["custPassword"];

    if ($pwd !== $custPwd){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $email){
    $custExist = emailExist($conn, $email);
    session_start();
    $_SESSION["custid"] = $custExist["custID"];
    $_SESSION["custemail"] = $custExist["custEmail"];
    $_SESSION["custname"] = $custExist["custName"];
    header("location: ../index.php");
    exit();
}