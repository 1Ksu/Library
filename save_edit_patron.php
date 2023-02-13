<?php

require_once("sql_connect.php");

$connection = new sqlConnect();
$connection->connect('root','root', 'practice', 'localhost', 3307);

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];
$patron_id = $_POST['patron_id'];


$myquery = "UPDATE patrons SET last_name='$last_name', first_name='$first_name', street_address='$street_address', city='$city' WHERE patron_id=$patron_id";
$result =$connection->query_result($myquery);

header('Location: patrons.php');
?>