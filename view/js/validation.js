function validateForm() {

    let password = document.forms["createForm"]["psw"].value;
  
    let passwordR = document.forms["createForm"]["psw_repeat"].value;

    if(password != passwordR) {
        alert("Wachtwoorden zijn niet hetzelfde.");
        return false;
    }

  }