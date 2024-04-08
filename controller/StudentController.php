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
        $this->model->create($name, $address, $postalcode, $city, $telephoneNr, $email, $hashedPass);
    }

    public function login($email, $password){
        $hashedPass = $this->model->getPass($email);
        var_dump($hashedPass['password']);
        var_dump(md5($password));
        if(md5($password) === $hashedPass){
            return true;
        }else{
            return false;
        }
    }
}