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
        <!-- champ affiché -->
        <section class="formChamp">
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
                <p id="errorAdresse" class="error"></p>
            </div>

            <!-- champ form siren-->
            <div class="siren">
                <label for="siren">Siren : </label>
                <input type="text" id="idSiren" name="siren">
                <p id="errorSiren" class="error"></p>
            </div>

            <!-- champ form mail-->
            <div class="mail">
                <label for="mail">Mail : </label>
                <input type="text" id="idMail" name="mail">
                <p id="errorMail" class="error"></p>
            </div>

        </section>
        <!-- /champ affiché -->


        <!-- champ caché -->
        <section>
            <!-- champ form codePostal-->
            <div class="codePostal">
                <input type="text" id="idCP" name="codePostal" hidden>
            </div>

            <!-- champ form rue-->
            <div class="rue">
                <input type="text" id="idRue" name="rue" hidden>
            </div>

            <!-- champ form ville-->
            <div class="ville">
                <input type="text" id="idVille" name="ville" hidden>
            </div>

            <!-- champ form latitude-->
            <div class="latitude">
                <input type="text" id="idLatitude" name="latitude" hidden>
            </div>

            <!-- champ form latitude-->
            <div class="longitude">
                <input type="text" id="idLongitude" name="longitude" hidden>
            </div>
        </section>
        <!-- /champ caché -->


        <!-- bouton d'envoie du formulaire -->
        <p><input type="submit" value="Valider"></p>
    </form>


    <?php
    //si le formulaire a été envoyé et que les valeurs sont definiees
    if (isset($_GET['siren'], $_GET['nom'], $_GET['prenom'], $_GET['adresse'], $_GET['mail'])) {
        echo "entrée dans le if \n <br/>";
        include "./db_connect.php";

        $requeteSqlIFExist = "SELECT * FROM `Producteur` WHERE `mail` = '" . $_GET['mail'] . "';";
        $requeteIfExist = $pdo->query($requeteSqlIFExist);
        $requete = $requeteIfExist->fetchAll();
        $nbLigneRequete = $requeteIfExist->rowCount();
        
        echo $nbLigneRequete."\n <br/>";

        if ($nbLigneRequete > 0) {
            echo "Cette adresse mail est deja utilisé !";
        } else {
            echo "entrée else \n <br/>";

            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $adresse = $_GET['adresse'];
            $siren = $_GET['siren'];
            $mailProducteur = $_GET['mail'];

            $to      = $mailProducteur;
            $subject = 'Verification de votre Adresse mail';
            $headers = array(
                'From' => 'maissa.rem08@gmail.com',
                'X-Mailer' => 'PHP/' . phpversion()
            );

            function generationLienAlea($length = 20)
            {
                $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $string = '';
                for ($i = 0; $i < $length; $i++) {
                    $string .= $chars[rand(0, strlen($chars) - 1)];
                }
                return $string;
            };

            $keyACoder = generationLienAlea();
            $key = password_hash($keyACoder, PASSWORD_BCRYPT);
            echo $key."<br/>";

            $lien = "localhost:8000/confirmMail.php?=" . $key;

            $message = '
        <html>
        <head>
      <title>Verification de l\'adresse mail</title>
     </head>
     <body>

     Bonjour ' . $nom . ' ' . $prenom . ',
     Vous venez de créer un compte sur Inscription Producteur. Avant de pouvoir utiliser votre compte, 
     vous devez vérifier que cette adresse e-mail est bien la vôtre en cliquant ici : <a href="' . $lien . '">Verifier</a>
     Cordialement, Circuit Court.
     </body>
     </html>';

            echo "envoie mail \n <br/>";

            mail($to, $subject, $message, $headers);
        }
    }
    ?>


</body>
<script type="text/javascript" src="./script.js"></script>Merci de bien vouloir remplir ce champ !



</html>