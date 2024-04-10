<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="view\css\styles.css">
        <script src="view\js\planLesson.js"></script>
        <script src="view\js\validation.js"></script>
    </head>
<body>
    <nav class="top-nav">
        <a href="/drivesmart">Home</a>
        <a href="contact">Contact</a>
        <?php if(isset($_SESSION['studentId'])) echo '<a href="myProfile">Mijn profiel</a>' ?>
        <?php if(isset($_SESSION['studentId'])) echo '<a href="dashboard">Dashboard</a>' ?>
        <?php if(isset($_SESSION['studentId'])) echo '<a href="planLesson">Les plannen</a>' ?>
        <?php if(!isset($_SESSION['loggedIn']))echo '<a href="login" id="login-nav">Inloggen</a>' ?>
        <?php if(isset($_SESSION['loggedIn'])) echo '<a href="logout" id="login-nav">Uitloggen</a>' ?>
    </nav>
    <!-- the navbar links are shown based on if user has a student id -->