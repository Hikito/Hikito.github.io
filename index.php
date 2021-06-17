<?php 
 
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
// Exception class. 
require 'phpmailer\6.2\src\Exception.php';
// The main PHPMailer class. 
require 'phpmailer\6.2\src\PHPMailer.php';
// SMTP class, needed if you want to use SMTP. */
require 'phpmailer\6.2\src\SMTP.php';
 
$mail = new PHPMailer; 
$orderid = 123;
$updatedate = "date";
$updatetime = "time";

$useremail = "hikitohackers@gmail.com";

$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'kokojarbot@gmail.com';   // SMTP username 
$mail->Password = 'AstaYuno123';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('kokojarbot@gmail.com', 'Koko Jar Shake'); 
 
// Add a recipient 
$mail->addAddress($useremail); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Your order Meow status has been changed'; 
 
// Mail body content 
$bodyContent = '<h1>Order Status Updated</h1>'; 
$bodyContent .= '<p>Hi Meow!, <br><br>
 
I Love You!</p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo "<script language='javascript'>alert('The order has been updated successfully.');</script>";
} 
 
?>