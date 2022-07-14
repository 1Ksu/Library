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

$search_word=$_POST['search'];

$zapros= "SELECT * FROM patrons WHERE patron_id=$search_word or last_name=$search_word or first_name=$search_word;
mysqli_query($link, $zapros);
header('Location: patrons.php');
/*$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);*/
?>