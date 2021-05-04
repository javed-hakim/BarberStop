<?php
require_once 'databhandler.php';
require_once 'functionsinc.php';
session_start();

$id = $_SESSION["userid"];
$fname = $_POST["fname"];
$sname = $_POST["sname"];
$pnum = $_POST["pnum"];
$pass = $_POST["pass"];
$bname = $_POST["bname"];
$add = $_POST["add"];
$serv1 = $_POST["serv1"];
$serv2 = $_POST["serv2"];
$serv3  = $_POST["serv3"];




if (!empty($fname)){
    upFname($conn, $fname, $id);
    
    
}
if (!empty($sname)){
    upSname($conn, $sname, $id);
    
    
}
if (!empty($pnum)){
    upPnum($conn, $pnum, $id);
    
    
}
if (!empty($pass)){
    upPass($conn, $pass, $id);
    
    
}
if (!empty($bname)){
    upBname($conn, $bname, $id);
    
    
}
if (!empty($add)){
    upAdd($conn, $add, $id);
    
    
}
if (!empty($serv1)){
    upServ1($conn, $serv1, $id);
    
    
}
if (!empty($serv2)){
    upServ2($conn, $serv2, $id);
    
    
}
if (!empty($serv3)){
    upServ3($conn, $serv3, $id);
    
    
}






//del($conn, $can, $bID);

