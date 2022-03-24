<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- feuille css -->
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>

<body>
    <form id="formInscription" method="get" action="./form.php">
        <!-- champ form nom -->
        <div class="name">
            <label for="nom">Nom : </label>
            <input type="text" id="nom" name="nom" placeholder="votre nom" required pattern="([A-Z]{1}[a-z]+)$|([A-Z]{1}[a-z]+-?[A-Z]{1}[a-z]+)" maxlength="30">
            <p id="errorNom" class="error"></p>
        </div>



        <!-- bouton d'envoie du formulaire -->
        <p><input type="submit" value="Valider"></p>
    </form>

</body>
    <script type="text/javascript" src="./script.js"></script>
</html>