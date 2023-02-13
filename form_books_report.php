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
    background-color: rgba(207, 166, 144, 1);
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
    border-bottom: 3px solid rgba(207, 166, 144, 1);
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
    background-color: rgba(207, 166, 144, 1);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}

.body_book_info {
    width: 100%;
    display: flex;
    justify-content: space-evenly;
    margin-top: 40px;
    margin-bottom: 20px;
    font-size: 18px;
}

.book_info {
    width: 55%;
    margin-left: auto;
    margin-right: 0;
    display: flex;
    justify-content: space-evenly;
}

.book_info input {
    font-size: 16px;
    background-color: rgba(237, 233, 222, 1);
    border: none;
    border: 3px solid rgba(207, 166, 144, 1);
    text-align: center;
    border-radius: 30px;
}
</style>

<body>
    <div class="page_title"> Книги </div>
    <form class="search" action="form_books_report.php " method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <form action="export_books_excel.php" method="post">
        <table>
            <tr style=" font-weight: bolder;">
                <td>Індекс</td>
                <td>Назва книги</td>
                <td>Прізвище автора</td>
                <td>Ім'я автора</td>
                <td>Дата публікації</td>
                <td>Назва видавництва</td>
                <td>Стан книги</td>
            </tr>

            <?php
            require_once("sql_connect.php");

            function filterData($str){
                $str=preg_replace("/\t/", "\\t", $str);
                $str=preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            }
            
            $fileName="members-data_" . date('Y-m-d') . ".xls";
            
            $fields = array ("book_id", "Назва книги", "Прізвище автора", "Ім'я автора", "Дата публікації", "Назва видавництва", "Стан книги");
            
            $excelData = implode("\t", array_values($fields)) . "\n";
            
            $connection = new sqlConnect();
            $connection->connect('root','root', 'practice', 'localhost', 3307);
            
            $search_word=$_POST['search'];
        
            if ($search_word==NULL){
                $myquery = "SELECT book_id, title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition FROM books";
            }
            else{
                $myquery = "SELECT book_id, title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition FROM books WHERE book_id LIKE'%$search_word%' OR title LIKE '%$search_word%' OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' ";
            }
            
            $result =$connection->query_result($myquery);
            $book_number=mysqli_num_rows($result);
            
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['book_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author_last_name'] . "</td>";
                echo "<td>" . $row['author_first_name'] . "</td>";
                echo "<td>" . date('d.m.Y', strtotime($row['year_of_publ'])) . "</td>";
                echo "<td>" . $row['publ_name'] . "</td>";
                echo "<td>" . $row['book_condition'] ."</td>";
                echo "</tr>"; 
            }

        ?>
        </table>
        <div class="body_book_info">
            <div class="book_info">
                <div>Кількість книжок <input type="number" name="book_number" value="<?php echo $book_number ?>"></div>
                <div>Вибірка <input type="text" name="search_word" value="<?php echo $search_word ?>"></div>
            </div>
        </div>
        <div class=" menu">
            <div>
                <button class="menu_button"><a href="books.php">Повернутися назад</a></button>
            </div>
            <div><button class="menu_button" type="submit"> Експорт в Excel </button></div>
            <!---->
        </div>
    </form>
</body>

</html>