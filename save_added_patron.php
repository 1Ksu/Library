<?php
require_once("sql_connect.php");

$connection = new sqlConnect();
$connection->connect('root','root', 'practice', 'localhost', 3307);

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];

$myquery = "INSERT INTO patrons (last_name, first_name, street_address, city) 
VALUES ('$last_name', '$first_name', '$street_address', '$city')";

$result =$connection->query_result($myquery);
header('Location: patrons.php');
?>