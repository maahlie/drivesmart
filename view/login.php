<?php
include("template/header.php")
?>
<br><br>
<form method="POST" action="loginCheck">

  <div class="container center">
    <h1>Login</h1>
    <hr>

    <label for="email"><b>E-mail: </b></label>
    <input type="text" placeholder="E-mail" name="email" required>

    <label for="psw"><b>Wachtwoord: </b></label>
    <input type="password" placeholder="Wachtwoord" name="psw" required>

    <button type="submit" name="submit_login">Login</button>
    <br><br>
    <a href="createStudent">Ik heb nog geen account</a>
  </div>

</form>

<?php
include("template/footer.php");
?>