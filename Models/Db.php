<?php
class DB {
    public $conn;


    public function __construct() {
        $servername = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "third_db";
        $this->conn = new mysqli($servername, $user, $pass, $dbname);
    }
}
?>
