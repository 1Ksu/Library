<?php
class sqlConnect{
    private $user; 
    private $password ;
    private $db;
    private $host;
    private $port;
    public $success;

    public function connect($user, $password, $db, $host, $port){
        $this->user = $user; 
        $this->password = $password; 
        $this->db = $db;
        $this->host = $host; 
        $this->port = $port;

        $link = mysqli_init();
        $mysqli = mysqli_real_connect($link, "localhost", "root", "root", "practice", 3307) or die ("Erro");
    }
    public function query($sql){
        $select = mysqli_query($this->success, $sql);
        return $select;
    }
    public function fetch($sql){
        $row = mysqli_fetch_array($this->query($sql));
        return $row;
    }
    public function close(){
        return mysqli_close($this->success);
    }
}
?>