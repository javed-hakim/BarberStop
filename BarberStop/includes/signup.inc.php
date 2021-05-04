<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_POST["submit"])){ //Make sure they came from right source (checks the post value)
    $fname=$_POST["fname"];
    $sname=$_POST["sname"];
    $email=filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $pnum=$_POST["pnum"];
    $pass=$_POST["pass"];
    
    require_once 'databhandler.php';
    require_once 'functionsinc.php';

    if (emptyInputS($fname,$sname,$email, $pnum ,$pass ) !==false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
        
    }
    if (invalidfname($fname) !==false) {
        header("location: ../signup.php?error=invalidFname");
        exit();
        
    }
    if (invalidsname($sname) !==false) {
        header("location: ../signup.php?error=invalidSname");
        exit();
        
    }
    if (Exists($conn, $email, $pnum) !==false) {
        header("location: ../signup.php?error=emailInuse");
        exit();
        
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        createUser($conn,$fname,$sname,$email, $pnum ,$pass);
    }else{
        header("location: ../signup.php?error=invalidemail");
        exit();
        
    }

    
    

    
}
else {
    header("location: ../signup.php");
    exit();
}
