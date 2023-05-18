<?php
session_start();
if(!isset($_SESSION["email"])){

    header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form onsubmit="return submitForm()" method="POST">
          <div class="form-group">
            <label for="passwordInput">Password:</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Enter password">
          </div>
          <div class="form-group">
            <label for="confirmPasswordInput">Confirm Password:</label>
            <input type="password" class="form-control" id="confirmPasswordInput" name="password" placeholder="Confirm password">
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="password">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS (optional if you need JavaScript functionality) -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  <!-- Add your JavaScript code -->
  <script>
    function submitForm() {
      var password = document.getElementById("passwordInput").value;
      var confirmPassword = document.getElementById("confirmPasswordInput").value;

      // Validate password and confirm password
      if(password =="" || confirmPassword==""){
        alert("Password and Confirm Password not empty");
        return false;
      }
     else if (password !== confirmPassword) {
        alert("Password and Confirm Password do not match.");
        return false; // Prevent form submission
      }

      // You can perform additional validations or further actions here

      // Submit the form or perform any other desired action
      
      return true; // Allow form submission
    }
  </script>
  <?php
  
  $email=$_SESSION["email"];
if(isset($_POST["password"])){
    include "conn.php";
$password=md5($_POST["password"]);
$update_password="UPDATE `std_master` SET `pwd`='$password' WHERE `e_mail_id`='$email'";
$row=mysqli_query($conn,$update_password);
if($row){
    echo "password change";
    header("refresh: 3;index.php");
}else{
    echo "something wrong";
}}
?>
</body>
</html>
