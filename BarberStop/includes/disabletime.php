<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once 'databhandler.php';
require_once 'functionsinc.php';
$bid = $_POST['barbid'];
$date = $_POST['date'];




$getrow = closedtimes($conn,$date, $bid);

echo $getrow;


