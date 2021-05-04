<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'databhandler.php';
require_once 'functionsinc.php';

$name = $_POST["change"];

$getrow = serviceincf($conn, $name);
echo $name;
echo $getrow["BarberService"];
$serv1 = $getrow["BarberService"];
$serv2 = $getrow["BarberService2"];
$serv3 = $getrow["BarberService3"];

$arraytemp = array();
$arraytemp[] = array("serv1" =>$serv1, "serv2" => $serv2, "serv3" => $serv3);


echo "<option>{$serv1}</option>";
echo "<option>{$serv2}</option>";
echo "<option>{$serv3}</option>";

