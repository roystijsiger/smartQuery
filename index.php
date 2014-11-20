<?php 
//linking to database
$mysqli = new mysqli("localhost","roystxh108_test","test123","roystxh108_test");

//defining queryStr & link
$queryStr = "INSERT INTO test(column1,column2)values(?,?)";

//including function.php 
include("function.php");

//defining needed variables
$columns = array("ID","Username");
$paramTypes = "ss";
$columnValues = array("test","Help4You");
$stmt = $mysqli->prepare($queryStr);

//object smartQuery 
$query = new smartQuery($mysqli,$queryStr,$parameterType,$stmt);

//executeQuery 
echo $query->executeQuery($columnValues,$paramTypes);

?>