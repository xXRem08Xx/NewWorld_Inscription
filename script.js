const regexNom = /([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)/g;

function verifNom() {
  var champNom = document.getElementById("idNom").value;
  var errorNom = document.getElementById("errorNom");

  if (champNom.length == 0) {
    errorNom.innerHTML = "Merci de bien vouloir remplir ce champ !";
  } else if (champNom.match(regexNom) == null) {
    errorNom.innerHTML = "Votre nom est incorrect ! Ex : Maissa";
    champNom.setCustomValidity("Votre nom est incorrect !");
  } else if (champNom.length < 2) {
    errorNom.innerHTML = "Votre nom est trop court ! 2 caracteres minimum";
    champNom.setCustomValidity("Votre nom est trop court ! 2 caracteres minimum");
  } else {
    errorNom.innerHTML = "";
    champNom.setCustomValidity("");
  }
  return false;
}

function verifPrenom() {
  var champNom = document.getElementById("idPrenom").value;
  var errorNom = document.getElementById("errorPrenom");

  if (champNom.length == 0) {
    errorNom.innerHTML = "Merci de bien vouloir remplir ce champ !";
    champNom.setCustomValidity("Merci de bien vouloir remplir ce champ !");
  } else if (champNom.match(regexNom) == null) {
    errorNom.innerHTML = "Votre prenom est incorrect ! Ex : Rémi";
    champNom.setCustomValidity("Votre prenom est incorrect !");
  } else if (champNom.length < 2) {
    errorNom.innerHTML = "Votre prenom est trop court ! 2 caracteres minimum";
    champNom.setCustomValidity("Votre prenom est trop court ! 2 caracteres minimum");
  } else {
    errorNom.innerHTML = "";
    champNom.setCustomValidity("");
  }
  return false;
}

const objetNom = document.getElementById("idNom");
objetNom.addEventListener("input", verifNom);
const objetPrenom = document.getElementById("idPrenom");
objetPrenom.addEventListener("input", verifPrenom);

//script autoCompletion adresse
$("#idAdresse").autocomplete({
  source: function (request, response) {
    $.ajax({
      url: "https://api-adresse.data.gouv.fr/search/? limit=8",
      data: { q: request.term },
      dataType: "json",
      success: function (data) {
        response(
          $.map(data.features, function (item) {
            return {
              label: item.properties.label,
              postcode: item.properties.postcode,
              city: item.properties.city,
              street: item.properties.street,
              name: item.properties.name,
              latitude: item.geometry.coordinates[1],
              longitude: item.geometry.coordinates[0],
            };
          })
        );
      },
    });
  },
  select: function (event, ui) {
    $("#idCP").val(ui.item.postcode);
    $("#idVille").val(ui.item.city);
    if (ui.item.street) {
      $("#idRue").val(ui.item.street);
    } else {
      $("#idRue").val(ui.item.name);
    }
    $("#idLatitude").val(ui.item.latitude);
    $("#idLongitude").val(ui.item.longitude);
  },
});

//siren
function checkSirenValidity() {
  var objetSiren = document.getElementById("idSiren");
  var valeurSiren = document.getElementById("idSiren").value;

  //on cree un bool pour savoir si une des adresse qui sont retourné corresponde a celle rentrée dans le form
  var boolAdresse = false;
  if (valeurSiren.length == 9) {
    var request = new XMLHttpRequest();

    var requestTexte =
      "https://entreprise.data.gouv.fr/api/sirene/v3/etablissements/?siren=" +
      valeurSiren;
    request.open("GET", requestTexte, true);
    request.setRequestHeader("Acces-control-Allow-Header", "*");
    request.setRequestHeader("Accept", "application/json");
    request.send();

    request.onreadystatechange = function (response) {
      if (request.readyState === 4) {
        if (request.status === 200) {
          var tabJsonInfo = JSON.parse(request.responseText);
          var noLigne;
          var lesEtab = tabJsonInfo.etablissements;

          var adresse = document.getElementById("idAdresse").value;
          var ville = document.getElementById("idVille").value;
          var codePostal = document.getElementById("idCP").value;

          objetSiren.setCustomValidity('Erreur, votre n° Siren ne correspond pas a votre adresse');

          lesEtab.forEach((unResultat) => {
            //si l'adresse ecrite correspond a celle de l'objet
            if (adresse == unResultat.geo_adresse) {
              //alors on tourne le boolAdresse a vrai
              boolAdresse = true;
              objetSiren.style.color = "green";
              objetSiren.setCustomValidity('');
            }
          });
        } //fin if si le status est egal a 200
        else {
          objetSiren.style.color = "red";
          objetSiren.setCustomValidity('Erreur, votre n° Siren est invalide');
        }
      } //fin if si l'etat est egal a 4
      else {
        objetSiren.setCustomValidity('Erreur, votre n° Siren est invalide');
        objetSiren.style.color = "red";
      }
    }; //fin de la fonction response
  } //fin si la taille est correcte
  else {
    objetSiren.style.color = "black";
  }
} //fin de la fonction

const objetSiren = document.getElementById("idSiren");
objetSiren.addEventListener("input", checkSirenValidity);
