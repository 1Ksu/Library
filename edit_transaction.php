<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a new book</title>
</head>
<style>
body {
    background: url(pictures/olia-gozha-J4kK8b9Fgj8-unsplash.jpg) 50%/cover no-repeat;
    background-size: 100%;
    margin: 0;
    width: 100%;
    height: 700px;
}

.main_block {
    display: flex;
    align-items: center;
    height: 700px;
    /*padding-top: 30px;
        padding-bottom: auto;*/
}

.color_block1 {
    width: fit-content;
    height: fit-content;
    padding: 50px;
    background-color: rgba(227, 227, 227, 1);
    margin-left: 50px;
}

.color_block2 {
    width: fit-content;
    height: fit-content;
    padding: 50px;
    background-color: rgba(88, 74, 63, 0.48);
    margin-right: auto;
    margin-left: auto;
    border-radius: 30px;
}

.form_style {
    width: fit-content;
    height: fit-content;
    padding: 50px;
    background-color: rgba(237, 233, 222, 1);
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    font-size: 26px;
}

.form_style a {
    text-decoration: none;
    color: black;
}

.form_style div {
    margin-top: 10px;
}

.form_style div input {
    font-size: 20px;
}

.menu {
    display: flex;
    justify-content: space-evenly;
    /*flex-direction: column;*/
    align-items: center;
}

.menu_button {
    margin-top: 5px;
    background-color: rgba(88, 74, 63, 0.48);
    font-size: 20px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
    text-decoration: none;
}
</style>

<body>
    <div class="main_block">
        <div class="color_block1">
            <div class="color_block2">
                <?php
                
                require_once("sql_connect.php");

                $connection = new sqlConnect();
                $connection->connect('root','root', 'practice', 'localhost', 3307);
                
                $transaction_id=$_GET['transaction_id'];

                $myquery = "SELECT * FROM transactions_view WHERE transaction_id=$transaction_id";
                $result =$connection->query_result($myquery);

                while ($row = mysqli_fetch_array($result)) 
                {
                    $transaction_type = $row['transaction_type'];
                    $transaction_date = date('Y-m-d', strtotime($row['transaction_date']));
                    $book_condition = $row['book_condition'];
                    $title = $row['title'];
                    $last_name = $row['last_name'];
                    $first_name = $row['first_name'];
                    $transaction_id = $row['transaction_id'];
                }
                ?>
                <script src="js./correct_input.js"></script>
                <form action="save_edit_transaction.php" method="post" class="form_style" enctype="multipart/form-data">
                    <div> Тип транзакції <input type="number" name="transaction_type"
                            value="<?php echo $transaction_type ?>">
                    </div>
                    <div> Дата транзакції <input type="date" name="transaction_date"
                            value="<?php echo $transaction_date ?>">
                    </div>
                    <div> Назва книги <input type="text" name="title" value="<?php echo $title ?>">
                    </div>
                    <div>Прізвище відвідувача <input type="text" name="last_name" value="<?php echo $last_name ?>"
                            onkeyup="lettersOnly(this)">
                    </div>
                    <div>Ім'я відвідувача <input type="text" name="first_name" value="<?php echo $first_name ?>"
                            onkeyup="lettersOnly(this)"></div>
                    <div>Стан книги <input type="number" name="book_condition" value="<?php echo $book_condition ?>">
                    </div>
                    <div style="visibility: collapse; font-size: 10px;">ID <input
                            style="font-size: 10px; margin-bottom: 0px;" type="text" name="transaction_id"
                            value="<?php echo $transaction_id ?>"></div>
                    <div class="menu">
                        <div> <button class="menu_button"> <a class="menu_a" href="transactions.php"> Повернутися назад
                                </a></button></div>
                        <div> <button class="menu_button" type="submit"> Змінити </button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>