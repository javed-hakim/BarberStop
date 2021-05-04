<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'databhandler.php';
require_once 'functionsinc.php';
if(isset($_POST["submit"])) {

    $date=$_POST["date"];
    $time=$_POST["time"];
    $serv=$_POST["serv"];
    $id = $_POST["userid"];
    $stat = "Active";
    $barb = $_POST["barber"];
    
    
   
    
    

    
    if (checkClose($conn, $date,$barb) !==false) {
        header("location: ../book.php?error=Closed");
        exit();
        
        
    }
    else{
        if (appExists($conn, $date, $time, $barb) !==false) {
            header("location: ../book.php?error=appbooked");
            exit();
            
        }

    }
    

    

    createBooking($conn, $serv, $date, $stat, $id, $time, $barb);

}
else{
    header("location: ../login.php");
    exit();
    
}