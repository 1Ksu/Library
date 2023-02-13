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

.menu button {
    margin-top: 30px;
    background-color: rgba(207, 166, 144, 1);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>

<body>
    <div class="page_title"> Книги </div>
    <form class="search" action="books.php" method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <table>
        <tr style=" font-weight: bolder;">
            <td>Індекс</td>
            <td>Назва книги</td>
            <td>Прізвище автора</td>
            <td>Ім'я автора</td>
            <td>Дата публікації</td>
            <td>Назва видавництва</td>
            <td>Стан книги</td>
            <td>Редагувати</td>
            <td>Видалити</td>
        </tr>

        <?php
            require_once("sql_connect.php");

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
            
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['book_id'] . "</td>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author_last_name'] . "</td>";
                echo "<td>" . $row['author_first_name'] . "</td>";
                echo "<td>" . date('d.m.Y', strtotime($row['year_of_publ'])) . "</td>";
                echo "<td>" . $row['publ_name'] . "</td>";
                echo "<td>" . $row['book_condition'] . "</td>";
                echo "<td align='center'><a class='a' href='edit_book.php?book_id=" . $row['book_id'] . "'>Редагувати<a/></td>";
                echo "<td align='center'><a class='a' href='delete_book.php?book_id=" . $row['book_id'] . "'>Видалити<a/></td>";
                echo "</tr>"; 
            }  
        ?>
    </table>
    <div class=" menu">
        <div> <a href="main_page.html"><button> Повернутися на головну </button> </a></div>
        <div> <a href="add_new_book.html"><button> Додати нову книгу </button> </a></div>
        <div><a href="form_books_report.php"><button> Сформувати звіт</button></a>
        </div>
    </div>
</body>

</html>

<!--<html>
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
    background-color: rgba(207, 166, 144, 1);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>

<body>
    <div class="page_title"> Книги </div>
    <form class="search" action="books.php" method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <table width="90%" border="1" cellspacing="1" style="border-collapse:collapse;">
        <tr align="center" style=" font-weight: bolder;">
            <td>Індекс</td>
            <td>Назва книги</td>
            <td>Прізвище автора</td>
            <td>Ім'я автора</td>
            <td>Дата публікації</td>
            <td>Назва видавництва</td>
            <td>Стан книги</td>
            <td>Редагувати</td>
            <td>Видалити</td>
        </tr>

        /*
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
            $query = "SELECT book_id, title, author_last_name, author_first_name, publ_name, book_condition FROM books";
            $date_query = "SELECT year_of_publ FROM books";
        }
        else {
            $query = "SELECT book_id, title, author_last_name, author_first_name, publ_name, book_condition FROM books WHERE book_id LIKE'%$search_word%' OR title LIKE '%$search_word%' OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' ";
            $date_query = "SELECT year_of_publ FROM books WHERE book_id LIKE '%$search_word%' OR title LIKE '%$search_word%' OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' ";
        }
        $rows=mysqli_query($link, $query);
        $date_row=mysqli_query($link, $date_query);
        while ($stroka = mysqli_fetch_array($rows) and $date_stroka = mysqli_fetch_array($date_row)) //book_id, title, author_last_name, author_first_name, DATE_FORMAT(year_of_publ, '%d.%m.%y'), publ_name, book_condition
        {
            echo "<tr>";
            echo "<td>" . $stroka['book_id'] . "</td>";
            echo "<td>" . $stroka['title'] . "</td>";
            echo "<td>" . $stroka['author_last_name'] . "</td>";
            echo "<td>" . $stroka['author_first_name'] . "</td>";
            echo "<td>" . date('d.m.Y', strtotime($date_stroka['year_of_publ'])) . "</td>";
            echo "<td>" . $stroka['publ_name'] . "</td>";
            echo "<td>" . $stroka['book_condition'] . "</td>";
            echo "<td align='center'><a class='a' href='edit_book.php?book_id=" . $stroka['book_id'] . "'>Редагувати<a/></td>";
            echo "<td align='center'><a class='a' href='delete_book.php?book_id=" . $stroka['book_id'] . "'>Видалити<a/></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div class="menu">
        <div> <a href="main_page.html"><button> Повернутися на головну </button> </a></div>
        <div> <a href="add_new_book.html"><button> Додати нову книгу </button> </a></div>
    </div>
</body>

</html>-->