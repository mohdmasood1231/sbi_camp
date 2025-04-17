<?php
ob_start();
//ini_set('session.gc_maxlifetime', 28800);
session_set_cookie_params(50000);
session_start();
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'DBConnect/MysqliDb.php';

//print_r($_SESSION);
