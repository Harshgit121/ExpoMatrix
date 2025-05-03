<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

include("connection.php");


function send_reset_link($email22,$role22)
{
    try {
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'bhargavundhad111@gmail.com';                     //SMTP username
        $mail->Password   = 'elkmwkiofxnprewt';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption 587
        $mail->Port       = 465;

        $mail->setFrom('bhargavundhad111@gmail.com');
        $mail->addAddress($email22);

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reset Password Notifications';
        // $mail->Body    = 'Verification cod ' . $verify_code;
        $body_template = " 
            <h2>Hello</h2>
            <h3>You are receiving this mail because we received a request for reset password your account</h3>
            <a href='http://localhost/TheDreamFair_01/password_change.php?mail=$email22&role=$role22'> Click Me </a>
        ";
        $mail->Body    = $body_template;
        $mail->send();
    } catch (Exception $e) {
        echo "Error :-" . $e;
    }
}

if (isset($_POST['forget_pass'])) {
    $email = $_POST['email1'];
    $check_mail = "select Email from organizer where Email='$email'";
    $check_mail_run = mysqli_query($conn, $check_mail);

    $check_mail1 = "select Email from vendor where Email='$email'";
    $check_mail_run1 = mysqli_query($conn, $check_mail1);

    $role1 = isset($_GET['role']) ? $_GET['role'] : '';
    echo htmlspecialchars($role1);

    $role23 = urlencode($role1);

    if ((mysqli_num_rows($check_mail_run) > 0) || (mysqli_num_rows($check_mail_run1)>0)) {
        send_reset_link($email,$role23);
        echo " Hello";
       
        // header("Location: pass.php?role=" . urlencode($role));
        // exit;
    }
}
