<?php
require_once("sql_connect.php");

$connection = new sqlConnect();

$connection->connect('root','root', 'practice', 'localhost', 3307);

$myquery= "DELETE FROM transactions WHERE transaction_id='".$_GET['transaction_id']."'";
$result = $connection->query_result($myquery);

header('Location: transactions.php');

$increment="ALTER TABLE transactions AUTO_INCREMENT=1";
$result = $connection->query_result($increment);
?>