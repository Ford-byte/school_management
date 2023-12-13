<?php 
require_once("server.php");

class Database {
    private $Dbconfig;
    private $test;

    public function __construct() {
        try {
            $this->Dbconfig = new PDO("mysql:host=".serverName."; dbname=".dbName, userName, passWord);
            $this->Dbconfig->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->Dbconfig->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->test = true; 
        } catch(PDOException $exception) {
            $this->test = false; 
            die("Error dbconfig connection: " . $exception->getMessage());
        }
    }

    public function GetDbconfig() {
        return $this->Dbconfig;
    }

    public function GetTestResult() {
        return $this->test;
    }
}
?>
