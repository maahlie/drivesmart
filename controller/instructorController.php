<?php

require_once "model/InstructorModel.php";

class InstructorController {

    private $model = '';

    function __construct() {
        $model = new InstructorModel();
        $this->model = $model;
    }
    
    //logs instructor in and puts userdata into the session to be used later
    public function login($email, $password){
        $hashedPass = $this->model->getPass($email);

        $profile = $this->model->getProfile($email);

        if(md5($password) == $hashedPass[0]['password']){
            $_SESSION["loggedIn"] = true;
            $_SESSION["instructorId"] = $profile[0]['id'];
            $_SESSION["name"] = $profile[0]['first_name'] . " " . $profile[0]['last_name'];
            $_SESSION["email"] = $email;
            $_SESSION["isAdmin"] = $email;

            return true;
        }else{
            return false;
        }
    }

}