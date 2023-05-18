<?php
include "conn.php";
 $otp="contactbikash2020@gmail.com";
   $Email='648857';
  $otp_search_query = "SELECT * FROM `verify_email` WHERE `email`='$otp' AND `otp`='$Email' ORDER BY `id` DESC LIMIT 1";
  if ($Query_result = mysqli_query($conn,$otp_search_query)) {
 if(mysqli_affected_rows($conn)>0){
  $result=mysqli_fetch_row($Query_result);
  echo $result['1'];
 }else{
    echo "not match";
 }}else{
    echo "query faild";
 }

?>