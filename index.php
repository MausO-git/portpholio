<?php
    session_start();
    if(isset($_SESSION['mailtoken'])){
        $mailToken = $_SESSION['mailtoken'];
        unset($_SESSION['mailtoken']);
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        include('partials/header.php')
    ?>
    <div id="contact" 
        <?php 
            if(isset($mailToken)){
                echo "data-token=".$mailToken;
            };
        ?>
    >
        <img class="arrow" src="images/pix_arrow.png" alt="flèche pixelisée">
        <form action="sentmail.php" method="POST">
            <?php
                if(isset($_GET['senterror'])){
                    echo "<div class='alert'>Une erreur est survenue (code erreur: ".$_GET['senterror'].")</div>";
                };

                if(isset($_GET['sent'])){
                    if($_GET['sent']=="success"){
                        echo "<div class='success'>Votre message a bien été envoyé</div>";
                    }
                }

                $_SESSION['token'] = bin2hex(random_bytes(32));
            ?>
            <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
            <div class="form-group">
                <label for="nom">Nom: </label>
                <input type="text" name="nom" id="nom" placeholder="Votre nom">
            </div>
            <div class="form-group">
                <label for="prenom">Prénom: </label>
                <input type="text" name="prenom" id="prenom" placeholder="Votre prénom">
            </div>
            <div class="form-group">
                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" placeholder="votre adresse e-mail">
            </div>
            <div class="form-group">
                <label for="message">Message: </label>
                <input type="textarea" name="message" id="message" placeholder="votre message">
            </div>
            <div class="sub">
                <input type="submit" value="Envoyer">
            </div>
        </form>
    </div>
    <div id="home" class="slide">
        <div class="nom">Oscar Maus</div>
        <div class="fonc">Web Developer</div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>