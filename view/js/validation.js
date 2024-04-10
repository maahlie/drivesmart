function validateForm() {

    let password = document.forms["createForm"]["psw"].value;
  
    let passwordR = document.forms["createForm"]["pswRepeat"].value;

    if(password.length < 8){
        alert("Wachtwoord moet minimaal 8 karakters lang zijn.");
        return false;        
    }
    
    if(password != passwordR) {
        alert("Wachtwoorden zijn niet hetzelfde.");
        return false;
    }

    
  }