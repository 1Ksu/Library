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
    background-color: rgba(204, 215, 146, 1);
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
    border-bottom: 3px solid rgba(204, 215, 146, 1);
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
    background-color: rgba(204, 215, 146, 1);
    font-size: 16px;
    border: none;
    padding: 10px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>

<body>
    <div class="page_title"> Відвідувачі </div>
    <form class="search" action="patrons.php" method="post">
        <input type="text" name="search">
        <button type="submit"> Пошук </button>
    </form>
    <table>
        <tr style=" font-weight: bolder;">
            <td>Індекс</td>
            <td>Прізвище відвідувача</td>
            <td>Ім'я відвідувача</td>
            <td>Адреса</td>
            <td>Місто</td>
            <td>Редагувати</td>
            <td>Видалити</td>
        </tr>

        <?php
        require_once("sql_connect.php");

        $connection = new sqlConnect();
        $connection->connect('root','root', 'practice', 'localhost', 3307);
        
        $search_word=$_POST['search'];
        
        if ($search_word==NULL){
            $myquery = "SELECT patron_id, last_name, first_name, street_address, city FROM patrons";
        }
        else {
            $myquery = "SELECT patron_id, last_name, first_name, street_address, city FROM patrons WHERE patron_id LIKE'%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%' ";
        }
        
        $result =$connection->query_result($myquery);

        while ($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['patron_id'] . "</td>";
            echo "<td>" . $row['last_name'] . "</td>";
            echo "<td>" . $row['first_name'] . "</td>";
            echo "<td>" . $row['street_address'] . "</td>";
            echo "<td>" . $row['city'] . "</td>";
            echo "<td align='center'><a class='a' href='edit_patron.php?patron_id=" . $row['patron_id'] . "'>Редагувати<a/></td>";
            echo "<td align='center'><a class='a' href='delete_patron.php?patron_id=" . $row['patron_id'] . "'>Видалити<a/></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <div class="menu">
        <div> <a href="main_page.html"><button> Повернутися на головну </button> </a></div>
        <div> <a href="add_new_patron.html"><button> Додати нового відвідувача </button> </a></div>
    </div>
</body>

</html>