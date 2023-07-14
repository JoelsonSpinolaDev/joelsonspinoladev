<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

//$mail->SMTPDebug = SMTP::DEBUG_SERVER; // show all the processes running

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "joelsonadolfospinola@gmail.com";
$mail->Password = "drqeuxlrjomcefen";
$mail->CharSet = "UTF-8"; // Set CharSet to UTF-8
$mail->setFrom($email, $name);
$mail->addAddress("joelsonadolfospinola@gmail.com", "Joelson Adolfo Santos Spínola");
$mail->Subject = $subject;
$mail->Body = $message;


// Send the email

if ($mail->send()) {
    // Email sent successfully
    // Send a thank you email back to the collected email address
    $thankYouEmail = new PHPMailer(true);

    $thankYouEmail->isSMTP();
    $thankYouEmail->SMTPAuth = true;

    $thankYouEmail->Host = "smtp.gmail.com";
    $thankYouEmail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $thankYouEmail->Port = 587;
    $thankYouEmail->Username = "joelsonadolfospinola@gmail.com";
    $thankYouEmail->Password = "drqeuxlrjomcefen";

    $thankYouEmail->setFrom("joelsonadolfospinola@gmail.com", "Joelson Adolfo Santos Spinola");
    $thankYouEmail->addAddress($email, $name);
    $thankYouEmail->Subject = "Thank You ";
    $thankYouEmail->Body = "Thank you ".$name.",\nFor your message! We appreciate your feedback.";

    $thankYouEmail->send();
    if ($thankYouEmail->send()) {
        // Thank you email sent successfully
        echo "success";
    } else {
        // Error sending thank you email
        echo "error";
    }
} else {
    // Error sending the main email
    echo "error";
}
?>
