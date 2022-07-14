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

$zapros= "DELETE FROM transactions WHERE transaction_id='".$_GET['transaction_id']."'";
mysqli_query($link, $zapros);
header('Location: transactions.php');
$increment="ALTER TABLE transactions AUTO_INCREMENT=1";
mysqli_query($link, $increment);
?>