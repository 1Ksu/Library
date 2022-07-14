<?php
$user = 'root';
$password = 'root';
$db = 'practice';
$host = 'localhost';
$port = 3307;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
) or die ("Error");


$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$street_address = $_POST['street_address'];
$city = $_POST['city'];

$zapros = "INSERT INTO patrons (last_name, first_name, street_address, city) 
VALUES ('$last_name', '$first_name', '$street_address', '$city')";//'$title', ,  or null
mysqli_query($link, $zapros);
header('Location: patrons.php');
/*$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);*/
?>