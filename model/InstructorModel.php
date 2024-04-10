<?php
require_once "db.php";

class InstructorModel {
    private $db = '';

    function __construct() {
        $db = new Db();
        $this->db = $db;
    }

    //gets a specific instructors name
    public function getName($id) {
        $result =  $this->db->selectWhere("instructor", "first_name, last_name", "id", " = ", $id);
        $name = $result[0]['first_name'] . " " . $result[0]['last_name'];
        return $name;
    }

    public function getPass($email) {
        $result =  $this->db->selectWhere("instructor", "password", "email", " = ", $email);
        
        return $result;
    }

    public function getEmail($id) {
        $result =  $this->db->selectWhere("instructor", "email", "id", " = ", $id);
        
        return $result;
    }

    public function getProfile($email) {
        $result =  $this->db->selectWhere("instructor", "id, first_name, last_name, email, is_admin", "email", " = ", $email);
        
        return $result;
    }

    public function getAvailable($id){
        //SELECT timeblock, date FROM `lessonblock` WHERE instructor_id = 1 AND student_id IS NULL AND report IS NULL;
        $result =  $this->db->selectNULL("lessonblock", "id, timeblock, date", "student_id", false, "AND report IS NULL AND instructor_id = $id");
        return $result;
    }

}