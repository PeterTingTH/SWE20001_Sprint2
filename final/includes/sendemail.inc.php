<?php
require_once('PHPMailer/PHPMailerAutoload.php');
require_once('PHPMailer/configMail.php');

if(isset($_POST['checkoutCart']))
{
    $mail = new PHPMailer;
    $mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;                                       
    $mail->Host = CONTACTFORM_SMTP_HOSTNAME;  
    $mail->Port = CONTACTFORM_SMTP_PORT;
    $mail->isHTML(true);                             
    $mail->Username = CONTACTFORM_SMTP_USERNAME;              
    $mail->Password = CONTACTFORM_SMTP_PASSWORD;                                                             
    $mail->SetFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME); 
    $mail->AddAddress('kchekfung@gmail.com');    
    $mail->Subject = 'Confirmation Order';
    $mail->Body    = "
    Thank you for ordering at Pinocone Catering Company!
    <br><a href='http://localhost/Kong/confirmationemail.php'>Click here to view your order!</a>
    ";

    $mail->Send();

    echo 'Email Sent.';
}

?>
