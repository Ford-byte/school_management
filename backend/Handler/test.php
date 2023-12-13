<?php 
require_once("../Connection/Dbconnect.php");
$db = new Database();
$test= $db->GetTestResult();

echo "test result:".$test;
?>