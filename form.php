<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- feuille css -->
    <link rel="stylesheet" href="style.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"> </script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js" integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous">
    </script>
</head>

<body>
    <form id="formInscription" method="get" action="./form.php">
        <!-- champ form nom -->
        <div class="name">
            <label for="nom">Nom : </label>
            <input type="text" id="idNom" name="nom" placeholder="votre Nom" class="ui-autocomplet-input" required pattern="([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)" maxlength="30">
            <p id="errorNom" class="error"></p>
        </div>

        <!-- champ form prenom -->
        <div class="name">
            <label for="prenom">Prenom : </label>
            <input type="text" id="idPrenom" name="prenom" placeholder="votre Prenom" required pattern="([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)" maxlength="30">
            <p id="errorPrenom" class="error"></p>
        </div>

        <!-- champ form adresse -->
        <div class="adresse">
            <label for="adresse">Adresse : </label>
            <input type="text" id="idAdresse" name="adresse" placeholder="Veuillez taper votre adresse ...">
        </div>

        <!-- champ form codePostal-->
        <div class="codePostal">
            <input type="text" id="idCP" name="codePostal" >
        </div>

        <!-- champ form rue-->
        <div class="rue">
            <input type="text" id="idRue" name="rue" hidden>
        </div>

        <!-- champ form ville-->
        <div class="ville">
            <input type="text" id="idVille" name="ville">
        </div>

        <!-- champ form latitude-->
        <div class="latitude">
            <input type="text" id="idLatitude" name="latitude" hidden>
        </div>

        <!-- champ form latitude-->
        <div class="longitude">
            <input type="text" id="idLongitude" name="longitude" hidden>
        </div>

        <!-- champ form siren-->
        <div class="siren">
            <label for="siren">Siren : </label>
            <input type="text" id="idSiren" name="siren" oninput="checkSirenValidity()">
        </div>



        <!-- bouton d'envoie du formulaire -->
        <p><input type="submit" value="Valider"></p>
    </form>

</body>
<script type="text/javascript" src="./script.js"></script>

</html>