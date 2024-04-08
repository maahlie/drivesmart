<?php
require "controller/StudentController.php";
$studentController = new StudentController();

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/view/';
$localDir = '/drivesmart/';

switch ($request) {
    case '':
    case '/':
    case $localDir:
        require __DIR__ . $viewDir . 'homepage.php';
        break;

    case $localDir . 'contact':
        require __DIR__ . $viewDir . 'contact.php';
        break;

    case $localDir . 'login':
        require __DIR__ . $viewDir . 'login.php';
        break;

    case $localDir . 'createStudent':
        require __DIR__ . $viewDir . 'createStudent.php';
        break;

    case $localDir . 'dashboard':
        require __DIR__ . $viewDir . 'dashboard.php';
        break;

    case $localDir . 'saveStudent':
        if(isset($_POST['submit_acc'])){
            $studentController->create($_POST['name'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['tel_nr'], $_POST['email'], $_POST['psw']);
        }

        require __DIR__ . $viewDir . 'createStudent.php';
        break;

    case $localDir . 'loginCheck':
        $login = false;
        if(isset($_POST['submit_login'])){
            $login = $studentController->login($_POST['email'], $_POST['psw']);
        }

        if($login == true) {
            $_SESSION["loggedIn"] = true;
            echo "yah";
            require __DIR__ . $viewDir . 'dashboard.php';
        } else {
            echo "nah";
            require __DIR__ . $viewDir . 'login.php';
        }
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}