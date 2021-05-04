<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

  include_once 'databhandler.php';
  include_once 'functionsinc.php';
  
$getid = $_POST["ID"];
echo $getid;

$sql = "UPDATE appointment SET appointmentStatus = 'Cancelled' WHERE appointmentID='{$getid}';";
if ($conn->query($sql)){
    echo"DataSaved";
}
else{
    echo $getid;
}