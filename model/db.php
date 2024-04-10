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
        
        // check if connection is made
        if ($mysqli->connect_error){
            echo "Failed to connect to the database : (".$mysqli->connect_error.")";
        }  
        
        $this->mysqli = $mysqli;
    }

    // basic select query
    public function select($table, $cols) {
        $sql = "SELECT $cols FROM $table";
        $result = $this->mysqli->query($sql);
        $array = $result -> fetch_all(MYSQLI_ASSOC);
        return $array;
    }

    // select query with WHERE and AND
    public function selectWhere($table, $cols, $where, $cond, $value, $and="") {
        $sql = "SELECT $cols FROM $table WHERE $where $cond '$value' $and";
        $result = $this->mysqli->query($sql);
        $array = $result -> fetch_all(MYSQLI_ASSOC);
        return $array;    
    }

    // select query to check if a column's value is null
    public function selectNULL($table, $cols, $where, $not=false, $and="") {
        if($not == true){
            $sql = "SELECT $cols FROM $table WHERE $where IS NOT NULL $and";
        } else if($not == false){
            $sql = "SELECT $cols FROM $table WHERE $where IS NULL $and";
        }
        $result = $this->mysqli->query($sql);
        $array = $result -> fetch_all(MYSQLI_ASSOC);
        return $array;    
    }
}