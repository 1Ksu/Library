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
$transaction_date = date('Y-m-d', strtotime($_POST['transaction_date']));
$book_condition = $_POST['book_condition'];
$transaction_id = $_POST['transaction_id'];


$b_id = mysqli_query($link,"SELECT * FROM books WHERE title LIKE '%$title%'");
$p_id = mysqli_query($link, "SELECT * FROM patrons WHERE last_name LIKE '%$last_name%' AND first_name LIKE '%$first_name%'");

while ($book_id=mysqli_fetch_array($b_id) and $patron_id=mysqli_fetch_array($p_id)){
    $b_id=$book_id['book_id'];
    $p_id=$patron_id['patron_id'];
    echo $b_id;
    echo $p_id;
    echo $title ;
    echo $transaction_type ;
    echo $last_name ;
    echo $first_name ;
    echo $transaction_date ;
    echo $book_condition ;
    echo $transaction_id ;
    $zapros = "UPDATE transactions SET transaction_date='$transaction_date', transaction_type='$transaction_type', book_condition='$book_condition', book_id='$b_id', patron_id='$p_id' WHERE transaction_id=$transaction_id";
    mysqli_query($link, $zapros);
}
header('Location: transactions.php');
/*$increment="ALTER TABLE books AUTO_INCREMENT=1";
mysqli_query($link, $increment);*/
?>