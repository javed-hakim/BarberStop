<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start(); //Start session in order to delete sess var's
session_unset(); //Unset sessions currently active
session_destroy(); //Essentially destorys session thus logging out

header("location: ../index.php");
        exit();