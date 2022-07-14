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


$title = $_POST['title'];
$author_last_name = $_POST['author_last_name'];
$author_first_name = $_POST['author_first_name'];
//$year_of_publ = $_POST['year_of_publ'];
$year_of_publ = date('Y-m-d', strtotime($_POST['year_of_publ']));
$publ_name = $_POST['publ_name'];
$book_condition = $_POST['book_condition'];

$zapros = "INSERT INTO books (title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition) 
VALUES ( '$title', '$author_last_name', '$author_first_name', '$year_of_publ', '$publ_name', '$book_condition')";//'$title', ,  or null
mysqli_query($link, $zapros);
header('Location: books.php');
/*$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);*/
?>