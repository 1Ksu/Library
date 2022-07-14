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

$zapros= "DELETE FROM books WHERE book_id='".$_GET['book_id']."'";
mysqli_query($link, $zapros);
header('Location: books.php');
$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);
?>