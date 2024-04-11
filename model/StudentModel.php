<?php

require_once "db.php";

class StudentModel {
    private $db = '';

    function __construct() {
        $db = new Db();
        $this->db = $db;
    }

    public function create($name, $address, $postalcode, $city, $telephoneNr, $email, $password) {
        $sql = "INSERT IGNORE INTO student (name, address, postalcode, city, phone, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->mysqli->prepare($sql);
        $stmt->bind_param("sssssss", $name, $address, $postalcode, $city, $telephoneNr, $email, $password);
        $stmt->execute();
        
        //check if email is new
        if($this->db->mysqli->affected_rows === 1) {
            $emailExists = false;
        }
        else {
            $emailExists = true;
        }
        return $emailExists;
    }
    
    public function getPass($email) {
        $result =  $this->db->selectWhere("student", "password", "email", " = ", $email);
        
        return $result;
    }

    public function getEmail($id) {
        $result =  $this->db->selectWhere("student", "email", "id", " = ", $id);
        
        return $result;
    }

    public function getProfile($email) {
        $result =  $this->db->selectWhere("student", "id, name, address, postalcode, city, phone", "email", " = ", $email);
        
        return $result;
    }

    public function update($name, $address, $postalcode, $city, $telephoneNr, $email, $id) {

        $emailDb = $this->getEmail($id);

        if($emailDb[0]['email'] == $email){
            $sql = "UPDATE student SET name = ?, address = ?, postalcode = ?, city = ?, phone = ? WHERE id = ?";
            $stmt = $this->db->mysqli->prepare($sql);
            $stmt->bind_param("sssssi", $name, $address, $postalcode, $city, $telephoneNr, $id);
        } else {
            $sql = "UPDATE IGNORE student SET name = ?, address = ?, postalcode = ?, city = ?, phone = ?, email = ? WHERE id = ?";
            $stmt = $this->db->mysqli->prepare($sql);
            $stmt->bind_param("ssssssi", $name, $address, $postalcode, $city, $telephoneNr, $email, $id);
        }

        $stmt->execute();

        //check if email is new
        if($this->db->mysqli->affected_rows == 1) {
            $emailExists = false;
            $_SESSION["name"] = $name;
            $_SESSION["address"] = $address;
            $_SESSION["postalcode"] = $postalcode;
            $_SESSION["city"] = $city;
            $_SESSION["telNr"] = $telephoneNr;
            $_SESSION["email"] = $email;
        }
        else {
            $emailExists = true;
        }
        return $emailExists;
    }

    public function delete() {
        //    
    }
}