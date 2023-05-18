<?php
include "conn.php";
$currentMonth = date('m');
$currentYear = date('Y');

// Construct the SQL query
// $query2 = "SELECT `Date` FROM `datewise_institute_status`
//           WHERE MONTH(`Date`) = $currentMonth AND YEAR(`Date`) = $currentYear
//           ORDER BY `Date` DESC
//           LIMIT 1";
// $query = "SELECT `att_entry`.`RegistrationNo`, `att_entry`.`TimeIN`, `att_entry`.`Att_Date`,`att_entry`.`TimeOUT`,`datewise_institute_status`.`Date`,`datewise_institute_status`.`Institute_Status` FROM `att_entry` INNER JOIN `datewise_institute_status` ON MONTH(`datewise_institute_status`.`Date`) = MONTH(CURDATE()) AND `att_entry`.`RegistrationNo`='2172' AND `att_entry`.";
// $query="SELECT `att_entry`.`RegistrationNo`, `att_entry`.`TimeIN`, `att_entry`.`Att_Date`,`att_entry`.`TimeOUT`,`datewise_institute_status`.`Date`,`datewise_institute_status`.`Institute_Status` FROM `att_entry` INNER JOIN `datewise_institute_status` ON  MONTH(`datewise_institute_status`.`Date`) = $currentMonth AND YEAR(`datewise_institute_status`.`Date`) = $currentYear AND `att_entry`.`RegistrationNo`='2172' AND MONTH(`att_entry`.`Att_Date`)=MONTH('2023-05-11')";
$query="SELECT `att_entry`.`RegistrationNo`, `att_entry`.`TimeIN`, `att_entry`.`Att_Date`,`att_entry`.`TimeOUT`,`datewise_institute_status`.`Date`,`datewise_institute_status`.`Institute_Status` FROM `att_entry` INNER JOIN `datewise_institute_status` ON MONTH(`datewise_institute_status`.`Date`) = '05' AND `att_entry`.`RegistrationNo`='2172'";

if($row=mysqli_query($conn,$query)){
if (mysqli_affected_rows($conn)>0) {
    $result=mysqli_fetch_assoc($row);
   foreach($row as $result){
     
       
     switch($result['Institute_Status'])    {
         case ($result['Date']==$result["Att_Date"]) && ($result['Institute_Status']==100):
                echo "running<br>";
                 break ;
            case 101:
             echo "close<br>";
                break; 
          case 102:
                echo "close<br>";
                 break;
             case 103:
                echo "sunday<br>";
             break; 
          case 104:
                echo "saturday<br>";
                break; 
          case 105:
                echo "suspend<br>";
             break; 
          case  106:
                echo "cancel<br>";
             break; 
            default:
            break;
             
     }
        if($result['Date']=="2023-05-11"){
            break;
        }
    
  
   }}}
    // foreach($row as $result){
    //     echo $result["Date"]."<br>";
    //     // // $data=($result["Date"]==$result["Att_Date"])?"RUNNING":($result["Institute_Status"]=="102")?"CLOSE":"fgfg";
    //     // $data = ($result["Date"] == $result["Att_Date"]) ? "RUNNING" : (($result["Institute_Status"] == "101") ? "CLOSE" : (($result["Institute_Status"] == "102") ? "sunday" : (($result["Institute_Status"] == "103") ? "saturday" : (($result["Institute_Status"] == "104") ? "holiday" : "fgfg"))));
    //     // echo $data."<br>";
        
    // }




?>