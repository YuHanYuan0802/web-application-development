<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	if (isset($_POST['submit'])) {
		$sender = $_POST['sender'];
		$receipt = $_POST['receipt'];
		$subject = $_POST['subject'];
		$body = $_POST['body'];

		$error = array();

		//remove sender and password field if using hardcode.

		if (empty($sender)) {
			$error[] = "Please enter sender." . "<br>";
		}
		if (empty($password)) {
			$error[] = "Please enter password." . "<br>";
		}
		if (empty($receipt)) {
			$error[] = "Please enter recipient." . "<br>";
		}
		if (empty($subject)) {
			$error[] = "Please enter subject." . "<br>";
		}
		if (empty($body)) {
			$error[] = "Please enter body." . "<br>";
		}
		if (!empty($error)) {
			foreach ($error as $displayerror) {
				echo $displayerror;
			}
			echo "<br>";
		} else {

			$mail->isSMTP();
			$mail->Host	 = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = $sender;	//sender and password can be hardcode. example: 'example@gmail.com'.
			$mail->Password = $password; //password from app password of your sender email. example: 'yourpassword'. https://support.google.com/mail/answer/185833?hl=en
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port	 = 465;

			$mail->setFrom($sender);
			$mail->addAddress($receipt);

			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $body;
			$mail->AltBody = $body;
			if ($mail->send()) {
				echo "Mail has been sent successfully!";
			} else {
				echo "Failed to send email.";
			}
		}
	}
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sent Email</title>
</head>

<body>
	<form action="" method="post">
		<label for="sender">Sender</label><br>
		<input type="text" name="sender" id="sender"><br>

		<label for="password">Password for sender</label><br>
		<input type="password" name="password" id="password"><br>

		<label for="receipt">Recipient</label><br>
		<input type="text" name="receipt" id="receipt"><br>

		<label for="subject">Subject</label><br>
		<input type="text" name="subject" id="subject"><br>

		<label for="body">Body</label><br>
		<input type="text" name="body" id="body"><br>

		<input type="submit" name="submit" value="Sent">
	</form>
</body>

</html>