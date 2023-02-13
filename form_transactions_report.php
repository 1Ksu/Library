<html>
<header>
    <title>Table with books</title>
</header>
<style>
body {
    background-color: rgba(227, 227, 227, 1);
}

.page_title {
    width: 95%;
    text-align: right;
    font-size: 30px;
    font-style: italic;
}

.search {
    display: flex;
    justify-content: space-evenly;
    width: 50%;
    vertical-align: middle;
    margin-top: 30px;
    margin-bottom: 30px;
}

.search button {
    margin: none;
    background-color: rgba(88, 74, 63, 0.48);
    font-size: 16px;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
    border: none;
    height: fit-content;
    border-radius: 30px;
}

.search input {
    border: none;
    border-bottom: 3px solid rgba(88, 74, 63, 0.48);
    background-color: rgba(227, 227, 227, 1);
    width: 50%;
    font-size: 18px;
}

table {
    border: 1px solid rgba(192, 188, 187, 1);
    width: 90%;
    border-spacing: 0;
    border-collapse: collapse;
    margin-left: auto;
    margin-right: auto;
    font-size: 20px;
}

th {
    border: 1px solid rgba(192, 188, 187, 1);
}

td {
    border: 1px solid rgba(192, 188, 187, 1);
    padding: 5px;
    text-align: center;
    font-size: 18px;
}

.menu {
    display: flex;
    justify-content: space-evenly;
    width: 50%;
}

.menu a {
    text-decoration: none;
    color: black;
    font-size: 16px;
}

.menu_button {
    margin-top: 30px;
    background-color: rgba(88, 74, 63, 0.48);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}

.body_transaction_info {
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    margin-top: 40px;
    margin-bottom: 20px;
    font-size: 18px;
}

.transaction_info {
    width: 68%;
    margin-left: auto;
    margin-right: 0;
    display: flex;
    justify-content: space-evenly;
}

.transaction_info input {
    font-size: 16px;
    background-color: rgba(237, 233, 222, 1);
    border: none;
    border: 3px solid rgba(88, 74, 63, 0.48);
    text-align: center;
    border-radius: 30px;
}
</style>

<body>
    <div class="page_title"> Транзакції </div>
    <form class="search" action="form_transactions_report.php" method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <form action="export_transactions_excel.php" method="post">
        <table>
            <tr style=" font-weight: bolder;">
                <td>Індекс</td>
                <td>Тип транзакції</td>
                <td>Дата транзакції</td>
                <td>Назва книги</td>
                <td>Прізвище автора</td>
                <td>Ім'я автора</td>
                <td>Прізвище відвідувача</td>
                <td>Ім'я відвідувача</td>
                <td>Стан книги</td>
                <td>Редагувати</td>
                <td>Видалити</td>
            </tr>

            <?php
        
        require_once("sql_connect.php");

        $connection = new sqlConnect();
        $connection->connect('root','root', 'practice', 'localhost', 3307);
        
        $search_word=$_POST['search'];
        
        $query_check_availability = "SELECT transaction_type FROM transactions_view WHERE title LIKE '%$search_word%' OR first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' ORDER BY transaction_id DESC LIMIT 1"; /*OR transaction_date LIKE '%$search_word%'  OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%'*/ 
        $result_check_availability=$connection->query_result($query_check_availability);
        while ($row_check_availability = mysqli_fetch_array($result_check_availability)){
            $check_availability = $row_check_availability['transaction_type'];
        }
        
        if ($search_word==NULL){
            $myquery = "SELECT transaction_id, transaction_date, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view";
            
            $book_availability = '-';
        }
        else {
            $myquery = "SELECT transaction_id, transaction_date, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view WHERE transaction_id LIKE '%$search_word%' OR title LIKE '%$search_word%' OR first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%'"; /*OR transaction_date LIKE '%$search_word%'  OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%'*/ 
            if($check_availability == 1){
                $book_availability = 'Немає в наявності';
            }
            else {
                $book_availability = 'Наявна';
            }
        }

        $result =$connection->query_result($myquery);
        $transactions_number=mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['transaction_id'] . "</td>";
            echo "<td>" . $row['transaction_type'] . "</td>";
            echo "<td>" . date('d.m.Y', strtotime($row['transaction_date'])) . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['author_last_name'] . "</td>";
            echo "<td>" . $row['author_first_name'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['book_condition'] . "</td>";
            echo "<td align='center'><a class='a' href='edit_transaction.php?transaction_id=" . $row['transaction_id'] . "'>Редагувати<a/></td>";
            echo "<td align='center'><a class='a' href='delete_transaction.php?transaction_id=" . $row['transaction_id'] . "'>Видалити<a/></td>";
            echo "</tr>";
        }
        
        ?>
        </table>
        <div class="body_transaction_info">
            <div class="transaction_info">
                <div>Кількість транзакцій <input type="number" name="transactions_number"
                        value="<?php echo $transactions_number ?>"></div>
                <div>Вибірка <input type="text" name="search_word" value="<?php echo $search_word ?>"></div>
                <div>Наявність книги <input type="text" name="book_availability"
                        value="<?php echo $book_availability ?>">
                </div>
            </div>
        </div>
        <div class="menu">
            <div> <button class="menu_button"> <a href="transactions.php">Повернутися назад </a></button> </div>
            <div> <button class="menu_button" type="submit"> Експорт в Excel </button></div>
        </div>
    </form>
</body>

</html>