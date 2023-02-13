<?php
require_once("sql_connect.php");

$connection = new sqlConnect();

$connection->connect('root','root', 'practice', 'localhost', 3307);

$myquery = "DELETE FROM books WHERE book_id='".$_GET['book_id']."'";
$result = $connection->query_result($myquery);

/*$update = "SET @num:=0;";
$update .= "UPDATE books SET book_id = @num := (@num+1); ";
$update_result = $connection->multi_query_result($update);



$set = "SET @num:=0";
$set_result = $connection->query_result($set);
echo $set;
echo $set_result;*/
header('Location: books.php');
$increment="ALTER TABLE books AUTO_INCREMENT=1";
$inc_result = $connection->query_result($increment);

?>