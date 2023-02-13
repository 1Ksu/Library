<?php
class sqlConnect{
    private $user; 
    private $password;
    private $db;
    private $host;
    private $port;
    public $conn;

    public function connect($user, $password, $db, $host, $port){
        $this->conn = mysqli_connect($host, $user, $password, $db, $port) or die ("Error");
    }

    public function query_result($sql){
        $select = mysqli_query($this->conn, $sql);
        return $select;
    }
    
    public function close(){
        return mysqli_close();
    }
}
?>