<?php
require_once "db.php";

class LessonModel {
    private $db = '';

    function __construct() {
        $db = new Db();
        $this->db = $db;
    }

    //makes lesson by putting student id in the desired lessonblock
    public function create($studentId, $lessonId) {
        $sql = "UPDATE lessonblock SET student_id = ? WHERE id = ?;";
        $stmt = $this->db->mysqli->prepare($sql);
        $stmt->bind_param("ii", $studentId, $lessonId);
        $stmt->execute();
        
    }

    //gets a specific students lessons if an id is passed, if not, retrieves all lessonblocks
    public function getLessons($id=false) {
        if($id != false){
            $result =  $this->db->selectWhere("lessonblock", "id, instructor_id, vehicle_license, date, timeblock", "student_id", " = ", $id);
        } else if($id === false) {
            $result =  $this->db->selectNULL("lessonblock", "id, instructor_id, vehicle_license, date, timeblock", "student_id");
        }


        return $result;
    }

    public function delete($id) {
        $sql = "UPDATE lessonblock SET student_id = NULL WHERE id = ?;";
        $stmt = $this->db->mysqli->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}