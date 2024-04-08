<?php

class Db
{
    // db login data
    private $dbHost     = "localhost";
    private $dbUser     = "root";
    private $dbPassword = "";
    private $dbName     = "drivesmart";

    public $mysqli = '';

    function __construct(){
        // connect to db
        $mysqli = new mysqli($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);	

        // check if connection is established
        if ($mysqli->connect_error){
            echo "Failed to connect to the database : (".$mysqli->connect_error.")";
        }  
        
        $this->mysqli = $mysqli;
    }

    public function select($table, $cols) {
        $sql = "SELECT $cols FROM $table";
        $result = $this->mysqli->query($sql);
        return $result;
    }

    public function selectWhere($table, $cols, $where, $cond) {
        $sql = "SELECT $cols FROM $table WHERE $where = '$cond'";
        $result = $this->mysqli->query($sql);
        return $result;
    }

}