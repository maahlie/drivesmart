<?php
include("template/header.php");
?>
<br><br>
<div id="contact-boxes">
    <div class="container">
    <form action="mailto:thomas.maly@student.gildeopleidingen.nl">

        <label for="fname">Voornaam: </label>
        <input type="text" id="fname" name="firstname" placeholder="Voornaam">

        <label for="lname">Achternaam:</label>
        <input type="text" id="lname" name="lastname" placeholder="Achternaam">

        <label for="subject">Onderwerp</label>
        <textarea id="subject" name="subject" placeholder="............" style="height:200px"></textarea>

        <input type="submit" value="Submit">

    </form>
    </div>

    <div class="container">
        <p>
            Rijschool DriveSmart<br>
            Stadsplateau 36<br>
            3521 AZ Utrecht<br>
            Tel: +31 24 642 67 65<br>
            E-mail: drivesmart@gmail.com<br>
            <br><br>
            KvK: 30215833<br>
            BTW nr.: NL 818275182 B 01<br>
        </p>
    </div>
</div>

<?php
include("template/footer.php");
?>