<?php
session_start();
require_once "controller/StudentController.php";
require_once "controller/LessonController.php";
require_once "controller/instructorController.php";
$studentController = new StudentController();
$lessonController = new LessonController();
$instructorController = new instructorController();

$request = $_SERVER['REQUEST_URI'];
$viewDir = '/view/';
$localDir = '/drivesmart/';

//routing, .htaccess catches all requests and sends them to index.php (here).
//the request is then looked at and a template is shown or a function is called if the request matches a case.
//if a request does not match a case it lands on default which shows a simple 404 template.
switch ($request) {
    //root routes go to homepage
    case '':
    case '/':
    case $localDir:
        require __DIR__ . $viewDir . 'homepage.php';
        break;

        //contact page
    case $localDir . 'contact':
        require __DIR__ . $viewDir . 'contact.php';
        break;

        //login page
    case $localDir . 'login':
        require __DIR__ . $viewDir . 'login.php';
        break;

        //student registration page
    case $localDir . 'createStudent':
        $error="";
        if(isset($_SESSION['error'])){
            $error = $_SESSION['error'];
            $_SESSION['error'] = "";
        }

        require __DIR__ . $viewDir . 'createStudent.php';
        break;

        //if logged in, show dashboard else redirect to login page, if user is student, show lessons
    case $localDir . 'dashboard':
        $error="";
        $blocksOld = "";
        $blocks = "";

        if(isset($_SESSION['loggedIn'])){
            if(isset($_SESSION['studentId'])){
                $blocksOld = $lessonController->showLessonsOld($_SESSION['studentId']);
                $blocks = $lessonController->showLessons($_SESSION['studentId']);
            }

            if(isset($_SESSION['error'])){
                $error =  $_SESSION['error'];
                $_SESSION['error'] = "";
            }  

            require __DIR__ . $viewDir . 'dashboard.php';
        }else{
            header('Location: login');
        }
        break;

        //if logged in, show unplanned lessonblocks else go to login
    case $localDir . 'planLesson':
        if(isset($_SESSION['studentId'])){
            $blocks = $lessonController->showLessons();
            require __DIR__ . $viewDir . 'planLesson.php';
        }else{
            header('Location: login');
        }
        break;
    
        //if logged in, assign selected lessonblock to student
    case $localDir . 'saveLesson':
        if(isset($_SESSION['studentId'])){
            $lessonController->create($_SESSION['studentId'], $_POST['lesson']);
            header('Location: dashboard');
        }else{
            header('Location: login');
        }
        break;

        //if logged in, change the lesson, checks for which button was pressed and calls function accordingly
    case $localDir . 'changeLesson':
        if(isset($_SESSION['studentId'])){
            if(isset($_POST['moveLesson'])){
                $succes = $lessonController->move($_POST['newLessonId'], $_POST['lessonId']);
                if($succes == true){
                    header('Location: dashboard');
                } else {
                    $_SESSION['error'] = "Deze is les is binnen de volgende 24 uur gepland, neem contact op met uw instructeur.";
                    header('Location: dashboard');
                }
            } else if(isset($_POST['cancelLesson'])){
                $succes = $lessonController->cancel($_POST['lessonId']);
                if($succes == true){
                    header('Location: dashboard');
                } else {
                    $_SESSION['error'] = "Deze is les is binnen de volgende 24 uur gepland, neem contact op met uw instructeur.";
                    header('Location: dashboard');
                }
            }
        }else{
            header('Location: login');
        }
        break;
    
                //if logged in, move selected lesson
    case $localDir . 'moveLesson':
        if(isset($_SESSION['studentId'])){
            // $succes = $lessonController->move($_POST['date'], $_POST['timeblock'], $_POST['lessonId']);
            var_dump($_POST['date']);
            var_dump($_POST['timeblock']);
            var_dump($_POST['lessonId']);
            $succes = true;
            if($succes == true){
                require __DIR__ . $viewDir . 'dashboard.php';
                // header('Location: dashboard');
            } else {
                $_SESSION['error'] = "Deze is les is binnen de volgende 24 uur gepland, neem contact op met uw instructeur.";
                header('Location: dashboard');
            }
        }else{
            header('Location: login');
        }
        break;

        //if logged in go to user profile
    case $localDir . 'myProfile':
        if(isset($_SESSION['studentId'])){
            require __DIR__ . $viewDir . 'profile.php';
        }else{
            header('Location: login');
        }
        break;

        //if submit button is pressed call function to save a new student, then redirect to dashboard, if email exists throw error and redirect to current page 
    case $localDir . 'saveStudent':
        if(isset($_POST['submitAcc'])){
            $emailExists = $studentController->create($_POST['name'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['telNr'], $_POST['email'], $_POST['psw']);

            if($emailExists == true){
                $_SESSION['error'] = "E-mail bestaat al.";
                header('Location: createStudent');
            } else {
                header('Location: dashboard');
            }
        }

        require __DIR__ . $viewDir . 'createStudent.php';
        break;

        //if submit button is pressed, call function to change student data, also checks if email exists
    case $localDir . 'changeStudent':
        if(isset($_SESSION['studentId'])){
            if(isset($_POST['submitChange'])){
                $emailExists = $studentController->update($_POST['name'], $_POST['address'], $_POST['postalcode'], $_POST['city'], $_POST['telNr'], $_POST['email'], $_SESSION['studentId']);
                
                if($emailExists == true){
                    header('Location: myProfile');
                } else {
                    header('Location: myProfile');
                }
            }
        }else{
            header('Location: login');
        }
        break;

        //calls login function on succes redirects to dashboard
        //checks if student is trying to login, if that fails, tries to login as instructor
    case $localDir . 'loginCheck':
        $login = false;
        if(isset($_POST['submit_login'])){
            $login = $studentController->login($_POST['email'], $_POST['psw']);

            if($login == false){
                $login = $instructorController->login($_POST['email'], $_POST['psw']);
            }
        }

        if($login == true) {
            header('Location: dashboard');
        } else {
            header('Location: login');
        }
        break;
    
        //logout route, destroys session, then redirects
    case $localDir . 'logout':
        session_destroy();
        header('Location: /drivesmart');
        break;

        //throws 404 error if request is not one of the cases
    default:
        http_response_code(404);
        require __DIR__ . $viewDir . '404.php';
}