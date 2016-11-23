<?php
function mailel($receiver,$sub,$msg,$attach=null){
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'lutonda@gmail.com';          	 // SMTP username
$mail->Password = 'lu7h0nd4orkut'; 								 // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                 // TCP port to connect to

$mail->setFrom('noreply@oreall.com', 'OREALL');
$mail->addReplyTo('email@codexworld.com', 'CodexWorld');
$mail->addAddress($receiver);   // Add a recipient
$mail->addCC('john@gmail.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML

$bodyContent  = "NOVA <hr><br>";
$bodyContent .= $msg;
$bodyContent .= '<hr><p>This is the HTML email sent from localhost using PHP script by <b>CodexWorld</b></p>';

$mail->Subject = $sub;
$mail->Body    = $bodyContent;
if($attach!=null){
addAttachment($attach[0], $attach[1]);
}
if(!$mail->send()) {
    return 'Message could not be sent.'.
    			 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    return 1;
}
}
?>
