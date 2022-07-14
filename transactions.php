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
    border-spacing: 0;
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

.menu button {
    margin-top: 30px;
    background-color: rgba(88, 74, 63, 0.48);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>

<body>
    <div class="page_title"> Транзакції </div>
    <form class="search" action="transactions.php" method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <table width="90%" border="1" cellspacing="1" style="border-collapse:collapse;">
        <tr align="center" style=" font-weight: bolder;">
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

        $search_word=$_POST['search'];
        
        if ($search_word==NULL){
            $query = "SELECT transaction_id, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view";
            $date_query = "SELECT transaction_date FROM transactions_view";
        }
        else {
            $query = "SELECT transaction_id, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view WHERE transaction_id LIKE '%$search_word%' OR title LIKE '%$search_word%' /*OR transaction_date LIKE '%$search_word%'  OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%'*/ ";
            $date_query = "SELECT transaction_date FROM transactions_view WHERE transaction_id LIKE '%$search_word%' OR transaction_date LIKE '%$search_word%' OR title LIKE '%$search_word%' OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%'";
        }

        $rows=mysqli_query($link, $query);
        $date_row=mysqli_query($link, $date_query);
        while ($stroka = mysqli_fetch_array($rows) and $date_stroka = mysqli_fetch_array($date_row)) //book_id, title, author_last_name, author_first_name, DATE_FORMAT(year_of_publ, '%d.%m.%y'), publ_name, book_condition
        {
            echo "<tr>";
            echo "<td>" . $stroka['transaction_id'] . "</td>";
            echo "<td>" . $stroka['transaction_type'] . "</td>";
            echo "<td>" . date('d.m.Y', strtotime($date_stroka['transaction_date'])) . "</td>";
            echo "<td>" . $stroka['title'] . "</td>";
            echo "<td>" . $stroka['author_last_name'] . "</td>";
            echo "<td>" . $stroka['author_first_name'] . "</td>";
            echo "<td>" . $stroka['last_name'] . "</td>";
            echo "<td>" . $stroka['first_name'] . "</td>";
            echo "<td>" . $stroka['book_condition'] . "</td>";
            echo "<td align='center'><a class='a' href='edit_transaction.php?transaction_id=" . $stroka['transaction_id'] . "'>Редагувати<a/></td>";
            echo "<td align='center'><a class='a' href='delete_transaction.php?transaction_id=" . $stroka['transaction_id'] . "'>Видалити<a/></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div class="menu">
        <div> <a href="main_page.html"><button> Повернутися на головну </button> </a></div>
        <div> <a href="add_new_transaction.html"><button> Додати нову транзакцію </button> </a></div>
    </div>
</body>

</html>

<!--CREATE VIEW `transactions` AS SELECT 
t.`transaction_id`, t.`transaction_date`, t.`transaction_type`, 
t.`book_condition`, t.`book_id`, t.`patron_id`, b.`title`, 
b.`author_first_name`, b.`author_last_name`, b.`book_condition`, 
p.`last_name`, p.`first_name`, p`street_address`, p.`city` 
FROM `transactions` AS t INNER JOIN `books` AS b 
ON t.`book_id`=b.`book_id` 
INNER JOIN `patrons` AS p 
ON t.`patron_id`=p.`patron_id`-->