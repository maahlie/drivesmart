<?php
session_start();
require_once "controller/StudentController.php";
require_once "controller/LessonController.php";
$studentController = new StudentController();
$lessonController = new LessonController();

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
        if ($_SESSION["loggedIn"] == true){
            if(isset($_SESSION['studentId'])) $blocks = $lessonController->read($_SESSION['studentId']);
            require __DIR__ . $viewDir . 'dashboard.php';
        }else{
            header('Location: login');
        }
        break;

    case $localDir . 'planLesson':
        if ($_SESSION["loggedIn"] == true){
            $blocks = $lessonController->read();
            require __DIR__ . $viewDir . 'planLesson.php';
        }else{
            header('Location: login');
        }
        break;
    
    case $localDir . 'saveLesson':
        if ($_SESSION["loggedIn"] == true){
            $lessonController->create($_SESSION['studentId'], $_POST['lesson']);
            header('Location: planLesson');
        }else{
            header('Location: login');
        }
        break;

    case $localDir . 'cancelLesson':
        if ($_SESSION["loggedIn"] == true){
            $lessonController->cancel($_POST['id']);
            header('Location: dashboard');
        }else{
            header('Location: login');
        }
        break;

    case $localDir . 'myProfile':
        if ($_SESSION["loggedIn"] == true){
            require __DIR__ . $viewDir . 'profile.php';
        }else{
            header('Location: login');
        }
        break;

    case $localDir . 'saveStudent':
        if(isset($_POST['submitAcc'])){
            $emailExists = $studentController->create($_POST['name'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['telNr'], $_POST['email'], $_POST['psw']);

            if($emailExists == true){
                echo "E-mail is al in gebruik.";
            } else {
                header('Location: dashboard');
            }
        }

        require __DIR__ . $viewDir . 'createStudent.php';
        break;

    case $localDir . 'changeStudent':
        if(isset($_POST['submitChange'])){
            $emailExists = $studentController->update($_POST['name'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['telNr'], $_POST['email'], $_SESSION['studentId']);
            require __DIR__ . $viewDir . 'profile.php';
            
            // if($emailExists == true){
            //     echo "E-mail is al in gebruik.";
            // } else {
            //     header('Location: dashboard');
            // }
        }

        break;

    case $localDir . 'loginCheck':
        $login = false;
        if(isset($_POST['submit_login'])){
            $login = $studentController->login($_POST['email'], $_POST['psw']);
        }

        if($login == true) {
            header('Location: dashboard');
        } else {
            echo "nah";
            require __DIR__ . $viewDir . 'login.php';
        }
        break;
    
    case $localDir . 'logout':
        session_destroy();
        header('Location: /drivesmart');
        break;

    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}