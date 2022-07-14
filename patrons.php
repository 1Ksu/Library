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
    <table width="90%" border="1" cellspacing="1" style="border-collapse:collapse;">
        <tr align="center" style=" font-weight: bolder;">
            <td>Індекс</td>
            <td>Прізвище відвідувача</td>
            <td>Ім'я відвідувача</td>
            <td>Адреса</td>
            <td>Місто</td>
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
            $query = "SELECT patron_id, last_name, first_name, street_address, city FROM patrons";
        }
        else {
            $query = "SELECT patron_id, last_name, first_name, street_address, city FROM patrons WHERE patron_id LIKE'%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%' ";
        }
        $rows=mysqli_query($link, $query);
        while ($stroka = mysqli_fetch_array($rows))
        {
            echo "<tr>";
            echo "<td>" . $stroka['patron_id'] . "</td>";
            echo "<td>" . $stroka['last_name'] . "</td>";
            echo "<td>" . $stroka['first_name'] . "</td>";
            echo "<td>" . $stroka['street_address'] . "</td>";
            echo "<td>" . $stroka['city'] . "</td>";
            echo "<td align='center'><a class='a' href='edit_patron.php?patron_id=" . $stroka['patron_id'] . "'>Редагувати<a/></td>";
            echo "<td align='center'><a class='a' href='delete_patron.php?patron_id=" . $stroka['patron_id'] . "'>Видалити<a/></td>";
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