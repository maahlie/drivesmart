<?php

require "model/LessonModel.php";
require_once "model/InstructorModel.php";

class LessonController {

    private $model = '';
    private $instructor = '';

    function __construct() {
        $model = new LessonModel();
        $InstructorModel = new InstructorModel();
        $this->instructor = $InstructorModel;
        $this->model = $model;
    }

    //makes lesson by putting student id in the desired lessonblock
    public function create($studentId, $lessonId) {
        $this->model->create($studentId, $lessonId);
    }

    public function read($id=false) {
        $lessons = $this->model->getLessons($id);
        $lessonBlocksHtml = "";
        if($id != false){
            foreach ($lessons as $lesson) {
                $lessonBlocksHtml .= "<div class='block' name='block' id='" . $lesson['date'] . "' style='display: block;'>
                                        <p>Instructeur: " . $this->instructor->getName($lesson['instructor_id']) . "</p>
                                        <p>Tijdstip: " . $lesson['timeblock'] . "</p>
                                        <form method='POST' onsubmit='return sure();' name='cancelLesson' action='cancelLesson'>
                                            <input type='hidden' value='" . $lesson['id'] . "' name='id'>
                                            <button type='submit' name='cancelLesson' >Les annuleren</button>
                                        </form>
                                     </div>";
            }
        }else{
            foreach ($lessons as $lesson) {
                $lessonBlocksHtml .= "<div class='block' name='block' id='" . $lesson['date'] . "' style='display: block;'>
                                        <p>Instructeur: " . $this->instructor->getName($lesson['instructor_id']) . "</p>
                                        <p>Tijdstip: " . $lesson['timeblock'] . "</p>
                                        <input type='radio' id='" . $lesson['id'] . "' name='lesson' value='" . $lesson['id'] . "'>
                                     </div>";
            }
        }

        return $lessonBlocksHtml;
    }

    public function cancel($id) {
        $this->model->delete($id);
    }

}