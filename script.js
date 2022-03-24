const regexNom = /([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)/g;

function verifNom() {
    var champNom = document.getElementById('nom').value;
    var errorNom = document.getElementById('errorNom');

    if(champNom.length == 0) {
        errorNom.innerHTML = "Merci de bien vouloir remplir ce champ !";
    }
    else if (champNom.length < 2 || champNom.match(regexNom) == null) {
        errorNom.innerHTML = "Votre nom est incorrect ! Ex : Maissa";
    }
    else {
        errorNom.innerHTML = '';
    }
    
 
    return false;
}

const objetNom = document.getElementById("nom");
objetNom.addEventListener('input', verifNom);
