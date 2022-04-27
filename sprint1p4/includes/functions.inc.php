<?php
// Validation on inputs
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

function adminEmailFormat($email){
    $result;
    $emailExt = explode('@',$email);
    $emailActualExt = strtolower(end($emailExt));
    if ($emailActualExt == 'pinocone.com'){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidPhone($phone){
    $result;
    if (!preg_match("/^[0-9]*$/", $phone)){
        $result = true;
    } else {
        if(strlen($phone) < 10 || strlen($phone) > 11){
            $result = true;
        } else {
            $result = false;
        }
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

function checkLinkExpire($conn,$linkExpireT){
    $result;
    $currentTime = date("U");
    if($currentTime > $linkExpireT){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function wrongPassword($conn, $email, $pwd){
    $custExist = custExist($conn, $email, "email");
    $custPwd = $custExist["custPassword"];

    if ($pwd !== $custPwd){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function wrongAdminPassword($conn, $email, $pwd){
    $adminExist = adminExist($conn, $email,"email");
    $adminPwd = $adminExist["adminPassword"];

    if ($pwd !== $adminPwd){
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

// Validate on database and get data
function custExist($conn, $input, $type){
    if($type == "email"){
        $sql = "SELECT * FROM custdata WHERE custEmail = ?;";
    }
    if($type == "id"){
        $sql = "SELECT * FROM custdata WHERE custID = ?;";
    }

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $input);
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

function vkeyExist($conn, $vkey){
    $sql = "SELECT * FROM custdata WHERE vKey = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $vkey);
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

function passResetKeyExist($conn, $passResetKey){
    $sql = "SELECT * FROM passwordreset WHERE passResetKey = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../forgetPass.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $passResetKey);
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

function deleteAccKeyExist($conn, $deleteAccKey){
    $sql = "SELECT * FROM deleteacc WHERE deleteAccKey = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../deleteAccConfirmation.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $deleteAccKey);
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

function adminExist($conn, $input, $type){
    if($type == "email"){
        $sql = "SELECT * FROM adminData WHERE adminEmail = ?;";
    }
    if($type == "id"){
        $sql = "SELECT * FROM adminData WHERE adminID = ?;";
    }

    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "s", $input);
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

// Create data into database
function createCustomer($conn, $name, $phone, $email, $pwd, $vkey){
    $sql = "INSERT INTO custdata (custName, custEmail, custPhone, custPassword, vKey) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $pwd, $vkey);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// Login
function loginUser($conn, $email){
    $custExist = custExist($conn, $email, "email");
    $custVerified = $custExist["verified"];

    if ($custVerified == 1){
        session_start();
        $_SESSION["custid"] = $custExist["custID"];
        header("location: ../index.php");
        exit();
    }
    else {
        header("location: ../login.php?error=not_verified");
        exit();
    }
}

function loginAdmin($conn, $email){
    $adminExist = adminExist($conn, $email, "email");
    session_start();
    $_SESSION["adminid"] = $adminExist["adminID"];
    header("location: ../admin.php");
    exit();
}

// Verify account
function validateEmail($conn, $vkey){
    $custExist = vkeyExist($conn, $vkey);
    $custVerified = $custExist["verified"];

    if ($custVerified == 0){
        $query = "UPDATE custdata SET verified = 1 WHERE vKey = '$vkey';";
        $result = mysqli_query($conn,$query);
        header("location: ../login.php?error=verified");
        exit();
    }
    else {
        header("location: ../login.php?error=already_verified");
        exit();
    }
}

function deleteUnactivateAccount($conn, $vkey){
    $custExist = vkeyExist($conn, $vkey);
    $custVerified = $custExist["verified"];

    if ($custVerified == 0){
        $query = "DELETE FROM custdata where vKey = '$vkey';";
        $result = mysqli_query($conn,$query);    
        header("location: ../login.php?error=delete_unactivated");
        exit();
    }
    else {
        header("location: ../login.php?error=already_verified");
        exit();
    }
}


// Send keys
function sendVKey($email, $vkey){
    require_once('../PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'pinocone.co@gmail.com';
    $mail->Password = 'SWE20001';
    $mail->SetFrom('pinocone.co@gmail.com');
    $mail->Subject = 'Pinocone Account Verification';
    $mail->Body = "
    Thank you for registering at Pinocone Catering Company!
    <br><a href='http://localhost/sprint1p4/includes/verify.inc.php?vkey=$vkey'>Click here to activate your account!</a>
    <br><a href='http://localhost/sprint1p4/includes/verify.inc.php?vkey=$vkey&delete=true'>Click here if this is not you.</a>
    ";
    $mail->AddAddress("$email");

    $mail->Send();
}

function sendPasswordKey($email,$passResetKey){
    require_once('../PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'pinocone.co@gmail.com';
    $mail->Password = 'SWE20001';
    $mail->SetFrom('pinocone.co@gmail.com');
    $mail->Subject = 'Pinocone Reset Password';
    $mail->Body = "
    <br><a href='http://localhost/sprint1p4/includes/checkResetKey.inc.php?passResetKey=$passResetKey'>Click here to reset your password!</a>
    <br><a href='http://localhost/sprint1p4/includes/checkResetKey.inc.php?passResetKey=$passResetKey&delete=true'>Click here if you did not ask for this.</a>
    ";
    $mail->AddAddress("$email");

    $mail->Send();
}

function sendDeleteKey($email,$deleteAccKey){
    require_once('../PHPMailer/PHPMailerAutoload.php');

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = '465';
    $mail->isHTML();
    $mail->Username = 'pinocone.co@gmail.com';
    $mail->Password = 'SWE20001';
    $mail->SetFrom('pinocone.co@gmail.com');
    $mail->Subject = 'Pinocone Delete Account';
    $mail->Body = "
    <br><a href='http://localhost/sprint1p4/includes/checkDeleteKey.inc.php?deleteAccKey=$deleteAccKey'>Click here to confirm delete your account!</a>
    <br><a href='http://localhost/sprint1p4/includes/checkDeleteKey.inc.php?deleteAccKey=$deleteAccKey&delete=true'>Click here if you did not ask for this.</a>
    ";
    $mail->AddAddress("$email");

    $mail->Send();
}

function resendVKey($conn, $email){
    $custExist = custExist($conn, $email, "email");
    $custVerified = $custExist["verified"];

    if ($custVerified == 0){
        $vkey = hash('sha256',time().$email);
        $query = "UPDATE custdata SET vKey = '$vkey' WHERE custEmail = '$email';";
        $result = mysqli_query($conn,$query);
        sendVKey($email,$vkey);
        header("location: ../resendVKey.php?error=send");
        exit();
    }
    else {
        header("location: ../resendVKey.php?error=already_verified");
        exit();
    }
}

// Remove keys
function removePassResetKey($conn,$emailRequest){
    $query = "DELETE FROM passwordreset where passResetEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
}

function removeDeleteAccKey($conn,$emailRequest){
    $query = "DELETE FROM deleteacc where deleteAccEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
}

// Send email
function sendResetPassword($conn, $email){
    $custExist = custExist($conn, $email, "email");
    $custVerified = $custExist["verified"];

    if ($custVerified == 1){
        removePassResetKey($conn,$email); 

        $passResetKey = hash('sha256',time().$email);
        $linkExpire = date("U") + 1800; 
        
        $sql = "INSERT INTO passwordreset (passResetEmail, passResetKey, passResetExpires) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../forgetPass.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sss", $email, $passResetKey, $linkExpire);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        sendPasswordKey($email,$passResetKey);
        header("location: ../forgetPass.php?error=send");
        exit();
    }
    else {
        header("location: ../forgetPass.php?error=not_verified");
        exit();
    }
}

function sendDeleteAcc($conn, $email){
    $custExist = custExist($conn, $email, "email");
    removeDeleteAccKey($conn,$email); 
    $deleteAccKey = hash('sha256',time().$email);
    $linkExpire = date("U") + 600; 
    
    $sql = "INSERT INTO deleteacc (deleteAccEmail, deleteAccKey, deleteAccExpires) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../deleteAccConfirmation.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $email, $deleteAccKey, $linkExpire);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    sendDeleteKey($email,$deleteAccKey);
    header("location: ../deleteAccConfirmation.php?error=send");
    exit();
}

// Reset password
function resetPassword($conn,$newPwd,$passResetKey){
    $requestExist = passResetKeyExist($conn, $passResetKey);
    $emailRequest = $requestExist["passResetEmail"];
    $query = "UPDATE custdata SET custPassword = '$newPwd' WHERE custEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
    removePassResetKey($conn,$emailRequest);
    header("location: ../forgetPass.php?error=reset");
    exit();
}

// Edit cust information
function editAccount($conn,$editEmail,$editName,$editPhone,$editPwd){
    $query = "UPDATE custdata SET custName = '$editName', custPhone = '$editPhone', custPassword = '$editPwd'  WHERE custEmail = '$editEmail';";
    $result = mysqli_query($conn,$query);
}

// Delete cust acc
function deleteCustAcc($conn,$emailRequest){
    $custExist = custExist($conn,$emailRequest,"email");
    $custID = $custExist['custID'];
    removeCustProfilePic($custID);

    $query = "DELETE FROM custdata where custEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
    $query = "DELETE FROM passwordreset where passResetEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
    $query = "DELETE FROM deleteacc where deleteAccEmail = '$emailRequest';";
    $result = mysqli_query($conn,$query);
}

// Remove cust profile pic
function removeCustProfilePic($custID){
    $deletedFileName = "../uploads/profileImg/profile".$custID."*";
    $deletedFileInfo = glob($deletedFileName);
    $deletedFileExt = explode(".",$deletedFileInfo[0]);
    $deletedFileActualExt = $deletedFileExt[3];
    
    $deletedFileURL = "../uploads/profileImg/profile". $custID . "." . $deletedFileActualExt;
    unlink($deletedFileURL);
}