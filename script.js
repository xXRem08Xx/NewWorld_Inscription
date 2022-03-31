const regexNom = /([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)/g;

function verifNom() {
  var champNom = document.getElementById("idNom").value;
  var errorNom = document.getElementById("errorNom");

  if (champNom.length == 0) {
    errorNom.innerHTML = "Merci de bien vouloir remplir ce champ !";
  } else if (champNom.match(regexNom) != null) {
    errorNom.innerHTML = "Votre nom est incorrect ! Ex : Maissa";
  } else if (champNom.length < 2) {
    errorNom.innerHTML = "Votre nom est trop court ! 2 caracteres minimum";
  } else {
    errorNom.innerHTML = "";
  }
  return false;
}

function verifPrenom() {
  var champNom = document.getElementById("idPrenom").value;
  var errorNom = document.getElementById("errorPrenom");

  if (champNom.length == 0) {
    errorNom.innerHTML = "Merci de bien vouloir remplir ce champ !";
  } else if (champNom.match(regexNom) != null) {
    errorNom.innerHTML = "Votre prenom est incorrect ! Ex : Rémi";
  } else if (champNom.length < 2) {
    errorNom.innerHTML = "Votre prenom est trop court ! 2 caracteres minimum";
  } else {
    errorNom.innerHTML = "";
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
  if (valeurSiren.length == 9) {
    var request = new XMLHttpRequest();

    var requestTexte = "https://entreprise.data.gouv.fr/api/sirene/v1/siren/" + valeurSiren;
    request.open("GET", requestTexte, true);
    request.setRequestHeader("Acces-control-Allow-Header", "*");
    request.setRequestHeader("Accept", "application/json");
    request.send();

    request.onreadystatechange = function (response) {
      if (request.readyState === 4) {

        if (request.status === 200) {

          var tabJsonInfo = JSON.parse(request.responseText);
          var noLigne;

          if (tabJsonInfo.total_results == 1) {
            objetSiren.style.color = "green";

            var adresseForm = document.getElementById("idAdresse").value;
            var villeForm = document.getElementById("idVille").value;
            var codePostalForm = document.getElementById("idCP").value;

            if(tabJsonInfo.code_postal === codePostalForm) {
                alert("sa marche !");
            }


          } //fin if si le Json renvoie 1 resultat
          else {
            objetSiren.style.color = "red";
          }
        } //fin if si le status est egal a 200
        else {
            objetSiren.style.color = "red";
        }
      } //fin if si l'etat est egal a 4
      else {
        objetSiren.style.color = "red";
      }
    }; //fin de la fonction response
  } //fin si la taille est correcte
} //fin de la fonction
const objetSiren = document.getElementById("idSiren");
objetSiren.addEventListener("input", checkSirenValidity);
