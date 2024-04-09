<?php

require "model/StudentModel.php";

class StudentController {

    private $model = '';

    function __construct() {
        $model = new StudentModel();
        $this->model = $model;
    }

    public function create($name, $address, $postalcode, $city, $telephoneNr, $email, $password) {
        $hashedPass = md5($password);
        $trimmedPost = trim(str_replace(' ', '', $postalcode), " ");
        $emailExists = $this->model->create(trim($name), trim($address), trim($trimmedPost), trim($city), trim($telephoneNr), trim($email), trim($hashedPass));

        if($emailExists == true){
            return true;
        } else {
            return false;
        }
    }

    public function update($name, $address, $postalcode, $city, $telephoneNr, $email, $id) {
        $trimmedPost = trim(str_replace(' ', '', $postalcode), " ");
        $emailExists = $this->model->update(trim($name), trim($address), trim($trimmedPost), trim($city), trim($telephoneNr), trim($email), $id);

        if($emailExists == true){
            return true;
        } else {
            return false;
        }
    }

    public function login($email, $password){
        $hashedPass = $this->model->getPass($email);

        $profile = $this->model->getProfile($email);

        if(md5($password) == $hashedPass[0]['password']){
            $_SESSION["loggedIn"] = true;
            $_SESSION["studentId"] = $profile[0]['id'];
            $_SESSION["name"] = $profile[0]['name'];
            $_SESSION["address"] = $profile[0]['address'];
            $_SESSION["postalcode"] = $profile[0]['postalcode'];
            $_SESSION["city"] = $profile[0]['city'];
            $_SESSION["telNr"] = $profile[0]['telephone_nr'];
            $_SESSION["email"] = $email;

            return true;
        }else{
            return false;
        }
    }

}