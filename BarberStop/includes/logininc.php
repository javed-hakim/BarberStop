<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

if(isset($_POST["submit"])) {

    $email=filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $pass=$_POST["pass"]; //Values posted from login.php
    

    require_once 'databhandler.php';
    require_once 'functionsinc.php';

    if (emptyInputL($email, $pass) !==false) {
        header("location: ../login.php?error=invalidinput");
        exit();
        
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        loginUser($conn, $email, $pass);

    }else{
        header("location: ../login.php?error=invalidinput");
        exit();
    }
    

}
else{
    header("location: ../login.php");
    exit();
    
}