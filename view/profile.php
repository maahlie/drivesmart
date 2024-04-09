<?php
include("template/header.php")
?>
<br><br>
<form method="POST" name="profileForm" action="changeStudent" onsubmit="return validateForm()">
  <div class="center container">
    <h1>Mijn profiel</h1>
    <hr>

    <label for="email"><b>Email:</b></label>
    <input type="text" name="email" value="<?php echo $_SESSION["email"] ?>">

    <label for="name"><b>Naam:</b></label>
    <input type="text" name="name"  value="<?php echo $_SESSION["name"] ?>">

    <label for="address"><b>Adres:</b></label>
    <input type="text" name="address" value="<?php echo $_SESSION["address"] ?>">
    
    <label for="city"><b>Woonplaats:</b></label>
    <input type="text" name="city" value="<?php echo $_SESSION["city"] ?>">

    <label for="postalcode"><b>Postcode:</b></label>
    <input type="text" name="postalcode" value="<?php echo $_SESSION["postalcode"] ?>">

    <label for="telNr"><b>Telefoon nr:</b></label>
    <input type="text" name="telNr" value="<?php echo $_SESSION["telNr"] ?>">

    <div class="clearfix">
        <br><br>
        <button type="submit" name="submitChange" class="signupbtn">Opslaan</button>
    </div>

  </div>
</form>


<?php
include("template/footer.php");
?>