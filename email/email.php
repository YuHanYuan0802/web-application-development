<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();										
	$mail->Host	 = "smtp.gmail.com";				
	$mail->SMTPAuth = true;							
	$mail->Username = 'yhanyuan2@gmail.com';				
	$mail->Password = 'wtftcsrnxiwotzsg';					
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;		
	$mail->Port	 = 465;

	$mail->setFrom('yhanyuan2@gmail.com');		
	$mail->addAddress('yuhanyuan0802@e.newera.edu.my');
	
	$mail->isHTML(true);								
	$mail->Subject = 'Subject';
	$mail->Body = 'HTML message body in <b>bold</b> ';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
    
    if ($mail->send()) {
        echo "Mail has been sent successfully!";
    }else {
        echo "Failed to send email.";
    }
	
	
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
