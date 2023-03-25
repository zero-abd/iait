<?php 
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['note'];
$formcontent="From: $name \nMessage: $message";
$recipient = "ahmedfarhan66067@gmail.com";
$subject = "Contact Form";
$mailheader = "From: $email\r\n";
mail($recipient, $subject, $formcontent, $mailheader);
?>
