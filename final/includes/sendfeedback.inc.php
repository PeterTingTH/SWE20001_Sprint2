<?php
    require_once('PHPMailer/PHPMailerAutoload.php');
    require_once('PHPMailer/configMail.php');

    if(isset($_POST['button_pressed']))
{
    $$mail = new PHPMailer;
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
    $mail->Subject = 'Feedback Form';
    $mail->Body    = "
    Thank you for ordering at Pinocone Catering Company! This is the feedback form of Pinocone Catering Company. You can choose to fill it out or not. 
    <br><a href='http://localhost/Kong/feedback.php'>Click here to fill your feedback!</a>
    ";

    $mail->Send();

    echo 'Email Sent.';
}
    ?>
