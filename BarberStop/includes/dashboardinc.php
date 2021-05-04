<?php
require_once 'databhandler.php';
require_once 'functionsinc.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$id = $_SESSION["userid"];
$d = $_POST["date"];

$can = "BClosed";
$bid = getbid($conn, $id);
$bID=($bid["BarberID"]);
$sql = "UPDATE appointment SET appointmentStatus = '{$can}' WHERE BarberID = '{$bID}' AND appointmentDate = '{$d}';";
$sql2 = "INSERT INTO appointment (appointmentDate, appointmentStatus, BarberID) VALUES ('{$d}', 'BClosed', '{$bID}')";
if ($conn->query($sql)){
    if($conn->query($sql2)){
        
    }

    
}
else{
    
    
    
}


