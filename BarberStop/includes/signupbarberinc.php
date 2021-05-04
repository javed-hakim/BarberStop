<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

if(isset($_POST["submit"])){ //Make sure they came from right source (checks the post value)
    $bLname=$_POST["sname"];
    $bFname=$_POST["fname"];
    $bActive="0";
    $bAdd=$_POST["add"];
    $bServ1=$_POST["serv1"];
    $bServ2=$_POST["serv2"];
    $bServ3=$_POST["serv3"];
    $bEmail=$_POST["email"];
    $bPass=$_POST["pass"];
    $bName=$_POST["name"];
    $bPnum=$_POST["pnum"];
    $type ="Barber";
    
    require_once 'databhandler.php';
    require_once 'functionsinc.php';

    if (emptyInputBS($bLname,$bFname,$bActive, $bAdd ,$bServ1, $bServ2, $bServ3, $bEmail, $bPass, $bName, $bPnum) !==false) {
        header("location: ../signupbarber.php?error=emptyinput");
        exit();
        
    }
    
    if (bExists($conn, $bEmail, $bPnum) !==false) {
        

      
        header("location: ../signupbarber.php?error=emailInuse");
        exit();
        
    }
    createBarber($conn,$bFname,$bLname,$bEmail, $bPnum ,$bPass, $type);
    $grab = Exists($conn, $bEmail, $bPnum);
        $grabid = $grab["usersID"];
        
    
    createShop($conn,$bActive, $bAdd ,$bServ1, $bServ2, $bServ3, $bName, $grabid);
    
    
    


    
    

    
}
else {
    
}
