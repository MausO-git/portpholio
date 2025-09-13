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
                <!-- <label for="nom">Nom: </label> -->
                <input type="text" name="nom" id="nom" placeholder="Votre nom">
            </div>
            <div class="form-group">
                <!-- <label for="prenom">Prénom: </label> -->
                <input type="text" name="prenom" id="prenom" placeholder="Votre prénom">
            </div>
            <div class="form-group">
                <!-- <label for="email">E-mail: </label> -->
                <input class="mail" type="email" name="email" id="email" placeholder="Votre adresse e-mail">
            </div>
            <div class="form-group form-message">
                <!-- <label for="message">Message: </label> -->
                <textarea name="message" id="message" placeholder="Votre message"></textarea>
            </div>
            <div class="sub">
                <input type="submit" value="Envoyer">
            </div>
        </form>
        <div class="reseaux">
            <h3>Autres réseaux</h3>
            <div class="res">
                <a href="https://github.com/MausO-git" target="_blank">
                    <img src="images/pxgit.png" alt="icone github en pixelart">
                </a>
            </div>
        </div>
    </div>