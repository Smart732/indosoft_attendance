<?php
session_start();
// if ($_SESSION["Email_true"]) {
//   # code...
// } elseif($_SESSION["Email_true"]){
//   # code...
// }elseif(){}


?>
<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    #show_Otp{
      display:none;
    }
  </style>
</head>
<body>
  <div class="container" id="show_Email">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="POST">
          <div class="form-group text-center">
            <label for="emailInput">Email:</label>
            <input type="email" class="form-control" id="emailInput" placeholder="Enter your email" name="Email">
            <div class="text-danger" id="Error_Email"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="Email_submit">Send OTP</button>
        
        </form>
      </div>
    </div>
  </div>
  <div class="container" id="show_Otp">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form method="POST">
          <div class="form-group text-center">
            <label for="otp">Otp:</label>
            <input type="nubmer" class="form-control" id="otp"  minlength="6" maxlength="6" placeholder="Enter 6-digit password" name="otp">
            <div class="text-danger" id="Error_Otp"></div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="Otp_submit">Verify Otp</button>
        
        </form>
      </div>
    </div>
  </div>


  
<?php

      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
      require './PHPMailer-master/src/Exception.php';
      require './PHPMailer-master/src/PHPMailer.php';
      require './PHPMailer-master/src/SMTP.php';
    if(isset($_POST["Email_submit"])){
  $Email = trim($_POST["Email"]);
  include "conn.php";
  $Email_search_query = "SELECT `e_mail_id` FROM `std_master` WHERE `e_mail_id`='".$Email."'";
  if ($Query_result = mysqli_query($conn, $Email_search_query)) {
 if(mysqli_num_rows($Query_result) > 0){

?>
<script>
  document.getElementById("Error_Email").innerText="Wait";
</script>
<?php
$mail = new PHPMailer(true);
try {
  $otp=rand(100000,999999);
  $_SESSION["guyth"]=$otp;
  //Server settings
  //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'contactsinghaniya@gmail.com';                     //SMTP username
  // $mail->Password   = 'omtjdymydpigwbxj';    
  $mail->Password  ="osfrdtvgimmsuqsp";//SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
  $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

  //Recipients
  $mail->setFrom('contactsinghaniya@gmail.com', 'Otp Verification ');
  $mail->addAddress($Email, 'Bikash');     //Add a recipient
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
  $mail->Body    = 'Hi Bikash,<br> <br>Welcome to Indosoft Computers King.<br> <br>Your Verification Code is '.$otp;
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  $mail->send();
  $_SESSION["email"]=$Email;
  $inset="INSERT INTO `verify_email`(`email`, `otp`) VALUES ('$Email','$otp')";
  $query=mysqli_query($conn,$inset);
  ?>
  <script>
  document.getElementById("Error_Email").innerText="Otp send";
  document.getElementById("show_Email").style.display="none";
  document.getElementById("show_Otp").style.display="block";
</script>
<?php
echo $otp;
  echo 'Message has been sent';
} catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



    } else {
      ?>
  <script>
  document.getElementById("Error_Email").innerText="email does not exist";
  </script>
  <?php
      // echo "email does not exist";
    }
  } else {
    echo "failed query";
  }
}elseif(isset($_POST["Otp_submit"])){
  include "conn.php";
  $Email=$_SESSION["email"];
  $otp=$_POST["otp"];
  $otp_search_query = "SELECT * FROM `verify_email` WHERE `email`='$Email' AND `otp`='$otp' ORDER BY `email`,`otp` DESC LIMIT 1";
  if ($Query_result = mysqli_query($conn,$otp_search_query)) {
 if(mysqli_affected_rows($conn)>0){
  
  header("Location:set_password.php");
  ?>
  <script>
    document.getElementById("show_Email").style.display="none";
  document.getElementById("show_Otp").style.display="none";
  document.getElementById("show_Password").style.display="block";
 </script>
<?php
}else{
  ?>
  <script>
 document.getElementById("show_Email").style.display="none";
  document.getElementById("Error_Otp").innerText="invaild otp";
  document.getElementById("show_Otp").style.display="block";
  </script>
  <?php
}
}else{
  echo "query faild";
}
}


?>
<script>
  function check_password() {
    let password=document.getElementById("password").value;
    let conform_password=document.getElementById("connform_password").value;
    if(password!=conform_password){
      console.log("password not match");
      return false;
    }
  }
</script>
  
  
</body>
</html>
