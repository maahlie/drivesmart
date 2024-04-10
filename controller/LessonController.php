<?php

require "model/LessonModel.php";
require_once "model/InstructorModel.php";

class LessonController {

    //init
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

    //gets lessons, for a student, or all upcoming free ones (if no id is passed). puts them in html blocks to be shown
    public function showLessons($id=false) {
        $lessons = $this->model->getLessons($id);
        $lessonBlocksHtml = "";
        if($id != false){
            foreach ($lessons as $lesson) {
                $availableTimes = $this->instructor->getAvailable($lesson['instructor_id']);
                $lessonBlocksHtml .= "<div class='block' name='block' id='" . $lesson['date'] . "' style='display: block;'>
                                        <p>Instructeur: " . $this->instructor->getName($lesson['instructor_id']) . "</p>
                                        <form method='POST' onsubmit='return sure();' name='changeLesson' action='changeLesson'>
                                        <select name='newLessonId' id='newLessonId'>
                                            <option value='" . $lesson['id'] . "' selected>" . $lesson['timeblock'] . " - " . $lesson['date'] .  "</option>";
                                            foreach ($availableTimes as $availableTime) {
                                                $lessonBlocksHtml .= "<option value='" . $availableTime['id'] . "'>" . $availableTime['timeblock'] . " - " . $availableTime['date'] .  "</option>";
                                            }
                $lessonBlocksHtml .=    "</select>
                                            <input type='hidden' value='" . $lesson['id'] . "' name='lessonId'>
                                            <button type='submit' name='cancelLesson' >Les annuleren</button>
                                            <button type='submit' name='moveLesson' >Les wijzigen</button>
                                        </form>
                                     </div>";
            }
        } else {
            foreach ($lessons as $lesson) {
                $lessonBlocksHtml .= "<div class='block' name='block' id='" . $lesson['date'] . "' style='display: block;'>
                                        <p>Instructeur: " . $this->instructor->getName($lesson['instructor_id']) . "</p>
                                        <p>Tijdstip: " . $lesson['timeblock'] . "</p>
                                        <p>Datum: " . $lesson['date'] . "</p>
                                        <input type='radio' id='" . $lesson['id'] . "' name='lesson' value='" . $lesson['id'] . "'>
                                     </div>";
            }
        }

        return $lessonBlocksHtml;
    }

    //gets old lessons for a student. puts them in html blocks to be shown
    public function showLessonsOld($id) {
        $lessons = $this->model->getPastLessons($id);
        $lessonBlocksHtml = "";
            foreach ($lessons as $lesson) {
                $lessonBlocksHtml .= "<div class='block' name='block' id='" . $lesson['date'] . "' style='display: block;'>
                                        <p>Instructeur: " . $this->instructor->getName($lesson['instructor_id']) . "</p>
                                        <p>Tijdstip: " . $lesson['timeblock'] . "</p>
                                        <p>Datum: " . $lesson['date'] . "</p>
                                        <p>Verslag: " . $lesson['report'] . "</p>
                                        <input type='hidden' value='" . $lesson['id'] . "' name='id'>
                                     </div>";
            }

        return $lessonBlocksHtml;
    }

    //if it is less than 24 hours until the selected lesson: delete
    public function cancel($id) {
        $lesson = $this->model->getLesson($id);
        $dateCat = $lesson[0]['date'] . " " . $lesson[0]['timeblock'];

        $date = strtotime($dateCat);

        if($this->timeCheck($date)){
            $this->model->delete($id);
            return true;  
        } else {
            return false;
        }
    }

    //if it is less than 24 hours until the selected lesson: change timeblock
    public function move($newLessonId, $lessonId) {
        $lesson = $this->model->getLesson($lessonId);
        $dateCat = $lesson[0]['date'] . " " . $lesson[0]['timeblock'];

        $date = strtotime($dateCat);

        if($this->timeCheck($date)){
            $this->model->moveLesson($newLessonId, $lessonId);
            return true;  
        } else {
            return false;
        }
    }

    //checks if something is within 24hours
    private function timeCheck($date){
        if($date > time() + 86400) {
            return true;
        } else {
           return false;
        }
    }
}