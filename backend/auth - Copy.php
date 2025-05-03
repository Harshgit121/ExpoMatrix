<?php 
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_mail($email)
{
    try
    {

    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'bhargavundhad111@gmail.com';                     //SMTP username
    $mail->Password   = 'elkmwkiofxnprewt';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption 587
    $mail->Port       = 465;
    
    $mail->setFrom('bhargavundhad111@gmail.com', 'ExpoMetrix');
    $mail->addAddress($email);     
    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Registration Information';
    // $mail->Body    = 'Verification cod ' . $verify_code;
    $mail->Body    = 'You Have Successfully Registered In The ExpoMetrix Website';
    $mail->send();
    }
    catch(Exception $e)
    {
        echo "Error :-" . $e;
    }
}

if (isset($_POST['register'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $fullname = $_POST['fullname'];
    $number = $_POST['number'];
    $user_type = $_POST['user_type'];
    $_SESSION['rolesession']=$user_type;

    if($user_type=='organizer')
    {
    $checkSql = "SELECT * FROM organizer WHERE User_Name='$username' AND Email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username or email already exists!";
        header("Location: login.php");
        exit();
    } else {
        $sql = "INSERT INTO organizer (User_Name,Passwo,Full_Name,Email,PhoneNumber) VALUES ('$username', '$pass', '$fullname','$email','$number')";
        if ($conn->query($sql)) {
            send_mail($email);
            header("Location: login.php?toggle=login");
            exit();
        } else {
            $_SESSION['error'] = "Registration failed: " . $conn->error;
            header("Location: login.php");
            exit();
        }
    }
}
elseif($user_type=='vendor')
{
    $checkSql = "SELECT * FROM vendor WHERE User_Name='$username' AND Email='$email'";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username or email already exists!";
        header("Location: login.php");
        exit();
    } else {
        $sql = "INSERT INTO vendor (User_Name,password,Full_Name,Email,PhoneNumber) VALUES ('$username', '$pass', '$fullname','$email','$number')";
        if ($conn->query($sql)) {
            send_mail($email);
            header("Location: login.php?toggle=login");
            exit();
        } else {
            $_SESSION['error'] = "Registration failed: " . $conn->error;
            header("Location: login.php");
            exit();
        }
    }
}
}
    
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type']; 
    $_SESSION['rolesession']=$user_type;

    if ($user_type === 'organizer') {
        $sql = "SELECT * FROM organizer WHERE User_Name='$username' AND Passwo='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password; 
            $_SESSION['role'] = 'organizer';
            header("Location: home.php");
            exit();
        }
    } elseif ($user_type === 'vendor') {
        $sql = "SELECT * FROM vendor WHERE User_Name='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username12'] = $username;
            $_SESSION['password12'] = $password; 
            $_SESSION['role'] = 'vendor';
            header("Location: dashboard.php");
            exit();
        }
    }

    $_SESSION['error'] = "Invalid username or password!";
    header("Location: login.php");
    exit();
}

// $conn->close();
?>