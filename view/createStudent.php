<?php
include("template/header.php")
?>
<br><br>
<form method="POST" name="createForm" action="saveStudent" onsubmit="return validateForm()">
  <div class="center container">
    <h1>Registratie</h1>
    <p>Vul de informatie in om een nieuw leerling account aan te maken.</p>
    <hr>

    <label for="email"><b>Email:</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="name"><b>Naam:</b></label>
    <input type="text" placeholder="Naam" name="name" required>

    <label for="address"><b>Adres:</b></label>
    <input type="text" placeholder="Adres" name="address" required>
    
    <label for="city"><b>Woonplaats:</b></label>
    <input type="text" placeholder="Woonplaats" name="city" required>

    <label for="postalcode"><b>Postcode:</b></label>
    <input type="text" placeholder="Postcode" name="postalcode" required>

    <label for="telNr"><b>Telefoon nr:</b></label>
    <input type="text" placeholder="06 4691053" name="telNr" required>

    <label for="psw"><b>Wachtwoord:</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <label for="psw_repeat"><b>Herhaal wachtwoord:</b></label>
    <input type="password" placeholder="Herhaal wachtwoord" name="psw_repeat" required>


    <div class="clearfix">
        <br><br>
        <button type="submit" name="submitAcc" class="signupbtn">Registreer</button>
        <br><br>
        <a type="button" class="cancel-btn" href="login">Cancel</a>
    </div>
    <p>Door een account aan te maken ben je het eens met onze <a href="#" style="color:dodgerblue">Privacy policy</a>.</p>

  </div>
</form>


<?php
include("template/footer.php");
?>