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
$transaction_type = $_POST['transaction_type'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
//$year_of_publ = $_POST['year_of_publ'];
$transaction_date = date('Y-m-d', strtotime($_POST['transaction_date']));
$book_condition = $_POST['book_condition'];

$b_id = mysqli_query($link,"SELECT * FROM books WHERE title LIKE '%$title%'");
$p_id = mysqli_query($link, "SELECT * FROM patrons WHERE last_name LIKE '%$last_name%' AND first_name LIKE '%$first_name%'");
while ($book_id=mysqli_fetch_array($b_id) and $patron_id=mysqli_fetch_array($p_id)){
    $b_id = $book_id['book_id'];
    $p_id = $patron_id['patron_id'];
    $zapros = "INSERT INTO transactions (transaction_type, transaction_date, book_condition, book_id, patron_id) 
    VALUES ( '$transaction_type', '$transaction_date', '$book_condition', '$b_id', '$p_id')";
    mysqli_query($link, $zapros);
    header('Location: transactions.php');
}

?>