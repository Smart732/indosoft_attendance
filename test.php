<?php
include "conn.php";
$query1 = "SELECT * FROM `datewise_institute_status` WHERE MONTH(`Date`)='05'";
$result1 = mysqli_query($conn, $query1);
while ($row_status = mysqli_fetch_assoc($result1)) {
    $status_date = $row_status["Date"];
    $institute_status = $row_status["Institute_Status"];
   // echo "Status: " . $status_date . "<br>";
    $query2 = "SELECT * FROM `att_entry` WHERE MONTH(`Att_Date`)='05' AND `RegistrationNo`='2172'";
    $result2 = mysqli_query($conn, $query2);
    $match_found = false;
 while ($row_att = mysqli_fetch_assoc($result2)) {
        $att_date = $row_att["Att_Date"];

        if ($status_date == $att_date) {
            $match_found = true;
            break;
        }
    }
if ($institute_status == 100) {
        if ($match_found) {
            echo "Present<br>";
        } else {
            echo "Absent<br>";
        }
    } else {
        echo "Status: " . $institute_status . "<br>";
    }
}

?>