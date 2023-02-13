<?php
require_once("sql_connect.php");

$connection = new sqlConnect();

$connection->connect('root','root', 'practice', 'localhost', 3307);

$myquery= "DELETE FROM patrons WHERE patron_id='".$_GET['patron_id']."'";
$result = $connection->query_result($myquery);

header('Location: patrons.php');

$increment="ALTER TABLE patrons AUTO_INCREMENT=1";
$result = $connection->query_result($increment);
?>