<?php

require_once "db.php";

class StudentModel {
    private $db = '';

    function __construct() {
        $db = new Db();
        $this->db = $db;
    }

    public function create($name, $address, $postalcode, $city, $telephoneNr, $email, $password) {
        $sql = "INSERT IGNORE INTO student (name, address, postalcode, city, telephone_nr, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->mysqli->prepare($sql);
        $stmt->bind_param("sssssss", $name, $address, $postalcode, $city, $telephoneNr, $email, $password);
        $stmt->execute();
        

        if($this->db->mysqli->affected_rows === 1) {
            // email was new, here you should send the email
            $emailExists = false;
            return $emailExists;
        }
        else {
            $emailExists = true;
            return $emailExists;
        }
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
        $result =  $this->db->selectWhere("student", "id, name, address, postalcode, city, telephone_nr", "email", " = ", $email);
        
        return $result;
    }

    public function update($name, $address, $postalcode, $city, $telephoneNr, $email, $id) {


        $emailDb = $this->getEmail($id);

        if($emailDb[0]['email'] === $email){
            $sql = "UPDATE student SET name = ?, address = ?, postalcode = ?, city = ?, telephone_nr = ? WHERE id = ?";
            $stmt = $this->db->mysqli->prepare($sql);
            $stmt->bind_param("sssssi", $name, $address, $postalcode, $city, $telephoneNr, $id);
        } else {
            $sql = "UPDATE IGNORE student SET name = ?, address = ?, postalcode = ?, city = ?, telephone_nr = ?, email = ? WHERE id = ?";
            $stmt = $this->db->mysqli->prepare($sql);
            $stmt->bind_param("ssssssi", $name, $address, $postalcode, $city, $telephoneNr, $email, $id);
        }

        $stmt->execute();


        if($this->db->mysqli->affected_rows === 1) {
            // email was new, here you should send the email
            $emailExists = false;
            return $emailExists;
        }
        else {
            $emailExists = true;
            return $emailExists;
        }
    }

    public function delete() {
        //    
    }
}