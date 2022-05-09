<?php
// Validation on inputs
function checkLinkExpire($linkExpireT){
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
        mysqli_close($conn);
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
        mysqli_close($conn);
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
        mysqli_close($conn);
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
        mysqli_close($conn);
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

function memberExist($conn, $loggedID){
    $sql = "SELECT * FROM custmembership WHERE custID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_close($conn);
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $loggedID);
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
function createCustomer($conn, $name, $email, $phone, $pwd, $vkey){
    $sql = "INSERT INTO custdata (custName, custEmail, custPhone, custPassword, vKey) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_close($conn);
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $pwd, $vkey);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $last_id = mysqli_insert_id($conn);

    $sql = "INSERT INTO custmembership (custID) VALUES (?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_close($conn);
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $last_id);
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
        mysqli_close($conn);
        header("location: ../index.php");
        exit();
    }
    else {
        mysqli_close($conn);
        header("location: ../login.php?error=not_verified");
        exit();
    }
}

function loginAdmin($conn, $email){
    $adminExist = adminExist($conn, $email, "email");
    session_start();
    $_SESSION["adminid"] = $adminExist["adminID"];
    mysqli_close($conn);
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
        mysqli_close($conn);
        header("location: ../login.php?error=verified");
        exit();
    }
    else {
        mysqli_close($conn);
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
        mysqli_close($conn);    
        header("location: ../login.php?error=delete_unactivated");
        exit();
    }
    else {
        mysqli_close($conn);
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
    <br><a href='http://localhost/sprint2p1/includes/verify.inc.php?vkey=$vkey'>Click here to activate your account!</a>
    <br><a href='http://localhost/sprint2p1/includes/verify.inc.php?vkey=$vkey&delete=true'>Click here if this is not you.</a>
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
    <br><a href='http://localhost/sprint2p1/includes/checkResetKey.inc.php?passResetKey=$passResetKey'>Click here to reset your password!</a>
    <br><a href='http://localhost/sprint2p1/includes/checkResetKey.inc.php?passResetKey=$passResetKey&delete=true'>Click here if you did not ask for this.</a>
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
    <br><a href='http://localhost/sprint2p1/includes/checkDeleteKey.inc.php?deleteAccKey=$deleteAccKey'>Click here to confirm delete your account!</a>
    <br><a href='http://localhost/sprint2p1/includes/checkDeleteKey.inc.php?deleteAccKey=$deleteAccKey&delete=true'>Click here if you did not ask for this.</a>
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
        mysqli_close($conn);
        header("location: ../resendVKey.php?error=send");
        exit();
    }
    else {
        mysqli_close($conn);
        header("location: ../resendVKey.php?error=already_verified");
        exit();
    }
}

// Remove keys
function removePassResetKey($conn,$idRequest){
    $query = "DELETE FROM passwordreset where passResetCustID = '$idRequest';";
    $result = mysqli_query($conn,$query);
}

function removeDeleteAccKey($conn,$idRequest){
    $query = "DELETE FROM deleteacc where deleteAccCustID = '$idRequest';";
    $result = mysqli_query($conn,$query);
}

// Send email
function sendResetPassword($conn, $email){
    $custExist = custExist($conn, $email, "email");
    $custVerified = $custExist["verified"];
    $idRequest = $custExist["custID"];

    if ($custVerified == 1){
        removePassResetKey($conn,$idRequest); 

        $passResetKey = hash('sha256',time().$email);
        $linkExpire = date("U") + 1800; 
        
        $sql = "INSERT INTO passwordreset (passResetCustID, passResetKey, passResetExpires) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            mysqli_close($conn);
            header("location: ../forgetPass.php?error=stmtfailed");
            exit();
        }
    
        mysqli_stmt_bind_param($stmt, "sss", $idRequest, $passResetKey, $linkExpire);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        sendPasswordKey($email,$passResetKey);
        mysqli_close($conn);
        header("location: ../forgetPass.php?error=send");
        exit();
    }
    else {
        mysqli_close($conn);
        header("location: ../forgetPass.php?error=not_verified");
        exit();
    }
}

function sendDeleteAcc($conn, $email){
    $custExist = custExist($conn, $email, "email");
    $idRequest = $custExist["custID"];

    removeDeleteAccKey($conn,$email); 
    $deleteAccKey = hash('sha256',time().$email);
    $linkExpire = date("U") + 600; 
    
    $sql = "INSERT INTO deleteacc (deleteAccCustID, deleteAccKey, deleteAccExpires) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        mysqli_close($conn);
        header("location: ../deleteAccConfirmation.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sss", $idRequest, $deleteAccKey, $linkExpire);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    sendDeleteKey($email,$deleteAccKey);
    mysqli_close($conn);
    header("location: ../deleteAccConfirmation.php?error=send");
    exit();
}

function sendRenewalReminder($email, $memberExpire){
    require_once('PHPMailer\PHPMailerAutoload.php');

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
    $mail->Subject = 'Pinocone Membership Renewal Reminder';
    $mail->Body = "
    Hello, thanks for subscribing to Pinocone membership! Your membership will be expiring after three days. To continue enjoy the benefits, please take note to renew once the membership expired.
    <br>Membership valid till $memberExpire.";
    $mail->AddAddress("$email");

    $mail->Send();
}

// Reset password
function resetPassword($conn,$newPwd,$passResetKey){
    $requestExist = passResetKeyExist($conn, $passResetKey);
    $idRequest = $requestExist["passResetCustID"];
    $query = "UPDATE custdata SET custPassword = '$newPwd' WHERE custID = '$idRequest';";
    $result = mysqli_query($conn,$query);
    removePassResetKey($conn,$idRequest);
    mysqli_close($conn);
    header("location: ../forgetPass.php?error=reset");
    exit();
}

// Edit cust information
function editAccount($conn,$loggedID,$editName,$editPhone,$editPwd){
    $query = "UPDATE custdata SET custName = '$editName', custPhone = '$editPhone', custPassword = '$editPwd'  WHERE custID = '$loggedID';";
    $result = mysqli_query($conn,$query);
}

// Delete cust acc
function deleteCustAcc($conn,$idRequest){
    removeCustProfilePic($idRequest);

    $query = "DELETE FROM custdata where custID = '$idRequest';";
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

// Subscribe Membership
function subscribeMembership($conn,$applyID,$memberEx){
    $query = "UPDATE custmembership SET custMembership = 1, custMembershipExpire = '$memberEx', reminded = 0 WHERE custID = '$applyID';";
    $result = mysqli_query($conn,$query);
}

// Cancel Membership
function cancelMembership($conn,$loggedID){
    $query = "UPDATE custmembership SET custMembership = 0, custMembershipExpire = null, reminded = 0 WHERE custID = '$loggedID';";
    $result = mysqli_query($conn,$query);
    mysqli_close($conn);
    header("location: ../membership.php");
    exit();
}

// Check through customer membership whether it expires
function checkMembershipExpire($conn){
    date_default_timezone_set("Asia/Kuala_Lumpur");

    $qry = mysqli_query($conn, "SELECT * FROM custmembership WHERE custMembership = 1");

    while($result = mysqli_fetch_assoc($qry)){
        $custID = $result["custID"];
        $memberExpire = $result["custMembershipExpire"];
        $remindTime = date('Y-m-d H:i:s', strtotime('- 3 days'));
        $currentTime = date('Y-m-d H:i:s');
        if($currentTime >= $memberExpire){
            $query = "UPDATE custmembership SET custMembership = 0 WHERE custID = '$custID';";
            $result = mysqli_query($conn,$query);
        } else if( $currentTime >= $remindTime){
            if($result["reminded"] == 0){
                $custExist = custExist($conn,$custID,"id");
                $email = $custExist["custEmail"];
                sendRenewalReminder($email,$memberExpire);
                $query = "UPDATE custmembership SET reminded = 1 WHERE custID = '$custID';";
                $result = mysqli_query($conn,$query);
            }
        }
    }
}

// Demo for Cron Jobs
function checkMembershipExpireCron($conn){
    date_default_timezone_set("Asia/Kuala_Lumpur");

    $qry = mysqli_query($conn, "SELECT * FROM custmembership WHERE custMembership = 1");

    while($result = mysqli_fetch_assoc($qry)){
        $custID = $result["custID"];
        $memberExpire = $result["custMembershipExpire"];
        $remindTime = date('Y-m-d H:i:s', strtotime('- 3 days'));
        $currentTime = date('Y-m-d H:i:s');
        if($currentTime >= $memberExpire){
            $query = "UPDATE custmembership SET custMembership = 0 WHERE custID = '$custID';";
            $result = mysqli_query($conn,$query);
        } else if( $currentTime >= $remindTime){
            if($result["reminded"] == 0){
                $custExist = custExist($conn,$custID,"id");
                $email = $custExist["custEmail"];
                sendRenewalReminderCron($email,$memberExpire);
                $query = "UPDATE custmembership SET reminded = 1 WHERE custID = '$custID';";
                $result = mysqli_query($conn,$query);
            }
        }
    }
}

function sendRenewalReminderCron($email, $memberExpire){
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
    $mail->Subject = 'Pinocone Membership Renewal Reminder';
    $mail->Body = "
    Hello, thanks for subscribing to Pinocone membership! Your membership will be expiring after three days. To continue enjoy the benefits, please take note to renew once the membership expired.
    <br>Membership valid till $memberExpire.";
    $mail->AddAddress("$email");

    $mail->Send();
}