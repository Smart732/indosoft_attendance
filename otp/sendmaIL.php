<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST['otp'])){
    $email=$_POST['otp'];
    $otp=rand(100000,999999);
    echo $email;
    try {
        //Server settings
         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'contactsinghaniya@gmail.com';                     //SMTP username
        // $mail->Password   = 'omtjdymydpigwbxj';    
        $mail->Password  ="yl1C3D[}URPO";//SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('contactsinghaniya@gmail.com', 'Otp Verification ');
        $mail->addAddress($email, 'Bikash');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'send';
        $mail->Body    = 'Hi Bikash,<br> <br>Welcome to Indosoft Computers King.<br> <br>Your Verification Code is '.$otp ;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        include "conn.php";
        
        $sql="INSERT INTO `verify_email`(`email`, `otp`) VALUES ('$email','$otp')";
       
        if(mysqli_query($conn,$sql)){
            echo "insert";
        }else{
            echo "faild";
        }
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}elseif(isset($_POST["forgot"])){
    // echo $_POST["send_otp"];
    echo $_POST["forgot"];
}elseif(isset($_POST['resent'])){
$email=$_POST['resent'];
include "conn.php";
$sql="SELECT * FROM `verify_email` WHERE `email`='$email' LIMIT 1";
if ($row=mysqli_query($conn,$sql)) {
    if (mysqli_affected_rows($conn)>0) {
        $result = mysqli_fetch_assoc($row);
        $otp=$result["otp"];
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contactsinghaniya@gmail.com';                     //SMTP username
            $mail->Password   = 'omtjdymydpigwbxj';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('contactsinghaniya@gmail.com', 'test mail ');
            $mail->addAddress($email, 'Bikash');     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'send';
            $mail->Body    = 'Hi Bikash,<br> <br>Welcome to Indosoft Computers King.<br> <br>Your Verification Code is '.$otp ;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        http_response_code(404);
        echo "no otp";
    }
    
} else {
    echo "faild query";
}
}else{
    echo "invalid request";
}







    




    


?>