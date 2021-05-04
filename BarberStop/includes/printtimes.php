<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'databhandler.php';
require_once 'functionsinc.php';
$arr = $_POST['arr'];
$dec = json_decode($arr, true);

$atimes = array("9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00","16:30", "17:00");
$atimeslength = sizeof($atimes);

if (empty($dec)){
    for($j = 0 ; $j < $atimeslength; $j++) {
        echo "<option>{$atimes[$j]} </option>";
              
    
           
        }
    }


else{
    $declength = sizeof($dec);


    for($j = 0 ; $j < $atimeslength; $j++) {
        $e = True;
        for($k = 0 ; $k < $declength; $k++) {
        
        
        if ($atimes[$j]===$dec[$k]['appointmentTime']) {
            $e = False;
            
            
            $k= $k+1;
            
            
            
            
            
            
            
        }else {
            
            
            
        }
        
        }
        if ($e === True){
            echo "<option>{$atimes[$j]} </option>";


        }
        
    }
    
    


}
