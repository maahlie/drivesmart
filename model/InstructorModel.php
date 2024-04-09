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

    public function delete() {
        //
    }
}