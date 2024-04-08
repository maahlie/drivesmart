<?php

require "db.php";

class StudentModel {
    private $db = '';

    function __construct() {
        $db = new Db();
        $this->db = $db;
    }

    public function create($name, $address, $postalcode, $city, $telephoneNr, $email, $password) {
        $stmt = $this->db->mysqli->prepare("INSERT INTO student (name, address, postalcode, city, telephone_nr, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $address, $postalcode, $city, $telephoneNr, $email, $password);
        $stmt->execute();
    }
    
    public function getPass($email) {
     $result =  $this->db->selectWhere("student", "password", "email", $email);

     return mysqli_fetch_assoc($result);
    }

    public function update() {
        //    
    }

    public function delete() {
        //    
    }
}