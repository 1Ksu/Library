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

$myquery = "INSERT INTO books (title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition) 
VALUES ( '$title', '$author_last_name', '$author_first_name', '$year_of_publ', '$publ_name', '$book_condition')";

$result =$connection->query_result($myquery);
header('Location: books.php');

?>