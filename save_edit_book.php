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
$year_of_publ = date('Y-m-d', strtotime($_POST['year_of_publ']));
$publ_name = $_POST['publ_name'];
$book_condition = $_POST['book_condition'];
$book_id = $_POST['book_id'];

echo $title; 
echo $author_last_name; 
echo $author_first_name; 
echo $year_of_publ;
echo $publ_name; 
echo $book_condition; 
echo $book_id;

$zapros = "UPDATE books SET title='$title', author_last_name='$author_last_name', author_first_name='$author_first_name', year_of_publ='$year_of_publ', publ_name='$publ_name', book_condition='$book_condition' WHERE book_id=$book_id";//'".$_GET['book_id']."' '$title', ,  or null
mysqli_query($link, $zapros);
header('Location: books.php');
/*$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);*/
?>