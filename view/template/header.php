<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="view\css\styles.css">
        <script src="view\js\planLesson.js"></script>
    </head>
<body>
    <nav class="top-nav">
        <a href="/drivesmart">Home</a>
        <a href="contact">Contact</a>
        <?php if(isset($_SESSION['loggedIn'])) echo '<a href="myProfile">Mijn profiel</a>' ?>
        <?php if(isset($_SESSION['loggedIn'])) echo '<a href="dashboard">Dashboard</a>' ?>
        <?php if(isset($_SESSION['loggedIn'])) echo '<a href="planLesson">Les plannen</a>' ?>
        <a href="login" id="login-nav">Inloggen</a>
        <?php if(isset($_SESSION['loggedIn'])) echo '<a href="logout" id="login-nav">Uitloggen</a>' ?>
    </nav>