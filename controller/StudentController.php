<?php

require "model/StudentModel.php";

class StudentController {

    private $model = '';

    function __construct() {
        $model = new StudentModel();
        $this->model = $model;
    }

    //creates a students account
    //hashes and saves password and trims postalcode so it will fit neatly in database
    //also checks if the email already exists, if so it returns a positive bool which lets the router know to display an error
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
    
    //updates a students account
    //also checks if the email already exists
    public function update($name, $address, $postalcode, $city, $telephoneNr, $email, $id) {
        $trimmedPost = trim(str_replace(' ', '', $postalcode), " ");
        $emailExists = $this->model->update(trim($name), trim($address), trim($trimmedPost), trim($city), trim($telephoneNr), trim($email), $id);

        if($emailExists == true){
            return true;
        } else {
            return false;
        }
    }

    //logs user in and puts userdata into the session to be used later
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
            $_SESSION["telNr"] = $profile[0]['phone'];
            $_SESSION["email"] = $email;

            return true;
        }else{
            return false;
        }
    }

}