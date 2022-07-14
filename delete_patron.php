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

$zapros= "DELETE FROM patrons WHERE patron_id='".$_GET['patron_id']."'";
mysqli_query($link, $zapros);
header('Location: patrons.php');
$increment="ALTER TABLE patrons AUTO_INCREMENT=1";
mysqli_query($link, $increment);
?>