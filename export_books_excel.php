<?php
include_once 'sql_connect.php';

function filterData($str){
    $str=preg_replace("/\t/", "\\t", $str);
    $str=preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

$fileName="Books_report_" . date('Y-m-d') . ".xls";

$fields = array ("book_id", "Назва книги", "Прізвище автора", "Ім'я автора", "Дата публікації", "Назва видавництва", "Стан книги");

$excelData = implode("\t", array_values($fields)) . "\n";

$connection = new sqlConnect();
$connection->connect('root','root', 'practice', 'localhost', 3307);
            
$search_word=$_POST['search_word'];
        
if ($search_word==NULL){
$myquery = "SELECT book_id, title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition FROM books";
}

else{
$myquery = "SELECT book_id, title, author_last_name, author_first_name, year_of_publ, publ_name, book_condition FROM books WHERE book_id LIKE'%$search_word%' OR title LIKE '%$search_word%' OR author_last_name LIKE '%$search_word%' OR author_first_name LIKE '%$search_word%' ";
}

$book_num = $_POST['book_number'];
$result =$connection->query_result($myquery);
            
while($row = mysqli_fetch_array($result)){
$lineData = array($row['book_id'], $row['title'], $row['author_last_name'], $row['author_first_name'], $row['year_of_publ'], $row['publ_name'], $row['book_condition']);
array_walk($lineData, 'filterData');
$excelData .= implode("\t", array_values($lineData)) . "\n";
}
$excelData .= "\n\t Кількість книг: \t" . $book_num . "\n";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$fileName\"");
header("Pragma: no-cache");
header("Expires: 0");
echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE", $excelData);  
 
exit;
?>