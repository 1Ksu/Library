<html>
<header>
    <title>Save edit</title>
</header>
<style>
.black_background_error {
    background-color: rgba(0, 0, 0, 0.685);
    position: fixed;
    z-index: 50;
    min-height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.error_body {
    width: 30%;
    background-color: rgba(237, 233, 222, 1);
    padding: 20px;
    font-size: 20px;
    border-radius: 30px;
    text-align: center;
}

.exit_button {
    width: 10%;
    background-color: rgba(237, 233, 222, 1);
    border-radius: 30px;
    padding: 10px;
    font-size: 18px;
    text-align: center;
    margin-top: 10px;
}

.exit_button a {
    text-decoration: none;
    color: black;
}
</style>

<body>
    <?php

    require_once("sql_connect.php");

    $connection = new sqlConnect();
    $connection->connect('root','root', 'practice', 'localhost', 3307);

    $title = $_POST['title'];
    $transaction_type = $_POST['transaction_type'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $transaction_date = date('Y-m-d', strtotime($_POST['transaction_date']));
    $book_condition = $_POST['book_condition'];
    $transaction_id = $_POST['transaction_id'];

    $query_b_id = "SELECT * FROM books WHERE title LIKE '%$title%'";
    $query_p_id = "SELECT * FROM patrons WHERE last_name LIKE '%$last_name%' AND first_name LIKE '%$first_name%'";

    $b_id = $connection->query_result($query_b_id);
    $p_id =$connection->query_result($query_p_id);
    
    if (mysqli_num_rows($b_id) !=1 or mysqli_num_rows($p_id) !=1) {
            echo "<div class='black_background_error'>
        <div class='error_body'>Сталася помилка при заповненні! Зверніть увагу на назву книги,
            ім'я або прізвище
        відвідувача</div>
        <div class='exit_button'><a href='edit_transaction.php'> Повернутися назад</a></div></div>";
        $transaction_id = $_POST['transaction_id'];
    }

    else {
        while ($book_id=mysqli_fetch_array($b_id) and $patron_id=mysqli_fetch_array($p_id))
        {
            $b_id=$book_id['book_id'];
            $p_id=$patron_id['patron_id'];
            
            $myquery = "UPDATE transactions SET transaction_date='$transaction_date', transaction_type='$transaction_type', book_condition='$book_condition', book_id='$b_id', patron_id='$p_id' WHERE transaction_id=$transaction_id";
            $result =$connection->query_result($myquery);
        }
        header('Location: transactions.php');
    }

    ?>
</body>

</html>