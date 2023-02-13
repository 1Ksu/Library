<?php

require_once("sql_connect.php");

$connection = new sqlConnect();
$connection->connect('root','root', 'practice', 'localhost', 3307);

$title = $_POST['title'];
$author_last_name = $_POST['author_last_name'];
$author_first_name = $_POST['author_first_name'];
$year_of_publ = date('Y-m-d', strtotime($_POST['year_of_publ']));
$publ_name = $_POST['publ_name'];
$book_condition = $_POST['book_condition'];
$book_id = $_POST['book_id'];

$myquery = "UPDATE books SET title='$title', author_last_name='$author_last_name', author_first_name='$author_first_name', year_of_publ='$year_of_publ', publ_name='$publ_name', book_condition='$book_condition' WHERE book_id=$book_id";//'".$_GET['book_id']."' '$title', ,  or null
$result =$connection->query_result($myquery);
header('Location: books.php');

?>