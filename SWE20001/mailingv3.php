<?php
include('header.php');


    use PHPMailer\PHPMailer\PHPMailer;
    function sendmail(){
        $name = "EX - Joey";  // Name of your website or yours
        $to = "liawbranden@gmail.com";  // mail of reciever
        $subject = $_POST['subject'];
        $body = $_POST['content'];
        $from = "fullergroup28@gmail.com";  // you mail
        $password = "chargepluggg";  // your mail password

        // Ignore from here

        require_once "PHPMailer.php";
        require_once "SMTP.php";
        require_once "Exception.php";
        $mail = new PHPMailer();

        // To Here

        //SMTP Settings
        $mail->isSMTP();
        //$mail->SMTPDebug = 3;  /// this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo "Email is sent!";
        } else {
            echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
    }


        // sendmail();  // call this function when you want to

        if (isset($_POST['sendmail'])) {
            sendmail();
        }
?>


<html>
    <head>
        <title>Send Mail</title>
    </head>
    <body>
        <form class="grey lighten-4 "  method="POST" >
        <h4 class="center">Send Newsletter</h4>
        <form class="grey lighten-4 "  method="POST" enctype="multipart/form-data">
            <label class="grey lighten-4">Subject</label>
            <input type="text" id="subject" name="subject">
 
            <label class="grey lighten-4">Content</label>
            <input type="text" id="content" name="content">

            <button type="submit" name="sendmail">sendmail</button>
        </form>
    </body>
</html>
