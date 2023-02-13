<?php
include_once 'sql_connect.php';

function filterData($str){
    $str=preg_replace("/\t/", "\\t", $str);
    $str=preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

$fileName="Transactions_report_" . date('Y-m-d') . ".xls";

$fields = array ("transaction_id", "Дата транзакції", "Тип транзакції", "Стан книги", "Назва книги", "Прізвище автора", "Ім'я автора", "Прізвище відвідувача", "Ім'я відвідувача", "Адреса", "Місто");

$excelData = implode("\t", array_values($fields)) . "\n";

$connection = new sqlConnect();
$connection->connect('root','root', 'practice', 'localhost', 3307);
            
$search_word=$_POST['search_word'];
        
if ($search_word==NULL){
    $myquery = "SELECT transaction_id, transaction_date, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view";
    $book_availability = "-";
}
else {
    $myquery = "SELECT transaction_id, transaction_date, transaction_type, book_condition, book_id, patron_id, title, author_last_name, author_first_name, last_name, first_name, street_address, city FROM transactions_view WHERE transaction_id LIKE '%$search_word%' OR title LIKE '%$search_word%' OR first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%'"; /*OR transaction_date LIKE '%$search_word%'  OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' OR last_name LIKE '%$search_word%' OR first_name LIKE '%$search_word%'*/
    $book_availability = $_POST['book_availability']; 
}

$transactions_num = $_POST['transactions_number'];
$result =$connection->query_result($myquery);
            
while($row = mysqli_fetch_array($result)){
$lineData = array($row['transaction_id'], $row['transaction_date'], $row['transaction_type'], $row['book_condition'], $row['title'], $row['author_last_name'], $row['author_first_name'], $row['last_name'], $row['first_name'], $row['street_address'], $row['city']);
array_walk($lineData, 'filterData');
$excelData .= implode("\t", array_values($lineData)) . "\n";
}
$excelData .= "\n\t Кількість транзакцій: \t" . $transactions_num . "\n";
$excelData .= "\n\t Наявність книги: \t" . $book_availability . "\n";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Pragma: no-cache");
header("Expires: 0");
echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE", $excelData);  
exit;
?>