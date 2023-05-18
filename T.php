<?php
include "conn.php";
$query1="SELECT * FROM `att_entry` WHERE MONTH(`Att_Date`)='05' AND `RegistrationNo`='2172'";
$query2="SELECT * FROM `datewise_institute_status` WHERE MONTH(`Date`)='05'";
$Query_att=mysqli_query($conn,$query1);
$Query_status=mysqli_query($conn,$query2);
if($query1 && $query2){
while ($row_att=mysqli_fetch_assoc($Query_att)) {
# code...
 $row_att["Att_Date"]."<br>";
while($row_status=mysqli_fetch_assoc($Query_status))
{
    if($row_att["Att_Date"]==$row_status["Date"]){
        echo "match<br>";
    }else{
        echo "not match<br>";
    }
    
}
break;
}
}else{
    echo "something";
}
// for($i=0;$i<6; $i++){
//     for($j=0;$j<10;$j++){
//          echo "iner<br>";
//         switch($i){
//             case 0:
//                 echo "0";
//                 break;
//             case 1:
//                 echo "1";
//                 break;
//             case 2:
//                 echo "2";
//                 break;
//             case 3:
//                 echo "3";
//                 break;
//             case 4:
//                 echo "4";
//                 break;
//             case 5:
//                  echo "5";
//                  break;
//             case 6:
//                     echo "6";
//                     break;
//             default:
//              echo "def";
//         }
//         break;
//     }
//      echo "outer<br>";
    
   
    
// }

?>