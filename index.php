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
        <div class="groupName">
            <img src="images/pix_arrow.png" class="right" alt="flèche droite">
            <div class="nom">Oscar Maus</div>
            <img src="images/pix_arrow_left.png" class="left" alt="flèche gauche">
        </div>
        <div class="fonc">Web Developer</div>
    </div>
    <div id="archive" class="slide">
         <div class="content">
            <h1 class='title'>Mes derniers projets</h1>
            <div class="card-container">
                <?php
                    require "connexion.php";

                    $req = $bdd->query("SELECT w.images AS wimg, w.nom AS nom, DATE_FORMAT(w.date, '%d/%m/%Y') AS euDate, w.link AS link, w.github AS github, t1.img AS img1, t2.img AS img2, t3.img AS img3 
                    FROM work w
                    INNER JOIN link_tw l ON w.id = l.id_work
                    LEFT JOIN tec t1 ON l.tec1 = t1.id
                    LEFT JOIN tec t2 ON l.tec2 = t2.id
                    LEFT JOIN tec t3 ON l.tec3 = t3.id
                    ORDER BY date DESC LIMIT 0,3") ;

                    while($don = $req->fetch(PDO::FETCH_ASSOC)){
                        echo "
                            <div class='card'>
                                <img src='images/site/".$don['wimg']."' alt='image représentant le site ".$don['nom']."'>
                                <div class='info'>
                                    <h2>".$don['nom']."</h2>
                                    <p>".$don['euDate']."</p>";
                                    
                            echo    "<div class='tec'>";
                                    if(isset($don['img1'])){
                                       echo "<img src='images/tec/".$don['img1']."' alt='logo de la tec1'>";
                                    }
                                    if(isset($don['img2'])){
                                        echo "<img src='images/tec/".$don['img2']."' alt='logo de la tec2'>"; 
                                    }
                                    if(isset($don['img3'])){
                                        echo "<img src='images/tec/".$don['img3']."' alt='logo de la tec3'>";
                                    }                          
                            echo        "</div>
                                </div>
                                <div class='blocLien'>
                                    <a class='bb' href=".$don['link']."><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill='#00df5d' d='M415.9 344L225 344C227.9 408.5 242.2 467.9 262.5 511.4C273.9 535.9 286.2 553.2 297.6 563.8C308.8 574.3 316.5 576 320.5 576C324.5 576 332.2 574.3 343.4 563.8C354.8 553.2 367.1 535.8 378.5 511.4C398.8 467.9 413.1 408.5 416 344zM224.9 296L415.8 296C413 231.5 398.7 172.1 378.4 128.6C367 104.2 354.7 86.8 343.3 76.2C332.1 65.7 324.4 64 320.4 64C316.4 64 308.7 65.7 297.5 76.2C286.1 86.8 273.8 104.2 262.4 128.6C242.1 172.1 227.8 231.5 224.9 296zM176.9 296C180.4 210.4 202.5 130.9 234.8 78.7C142.7 111.3 74.9 195.2 65.5 296L176.9 296zM65.5 344C74.9 444.8 142.7 528.7 234.8 561.3C202.5 509.1 180.4 429.6 176.9 344L65.5 344zM463.9 344C460.4 429.6 438.3 509.1 406 561.3C498.1 528.6 565.9 444.8 575.3 344L463.9 344zM575.3 296C565.9 195.2 498.1 111.3 406 78.7C438.3 130.9 460.4 210.4 463.9 296L575.3 296z'/></svg>Voir site</a>
                                    <a href=".$don['github']."><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill='#00df5d' d='M237.9 461.4C237.9 463.4 235.6 465 232.7 465C229.4 465.3 227.1 463.7 227.1 461.4C227.1 459.4 229.4 457.8 232.3 457.8C235.3 457.5 237.9 459.1 237.9 461.4zM206.8 456.9C206.1 458.9 208.1 461.2 211.1 461.8C213.7 462.8 216.7 461.8 217.3 459.8C217.9 457.8 216 455.5 213 454.6C210.4 453.9 207.5 454.9 206.8 456.9zM251 455.2C248.1 455.9 246.1 457.8 246.4 460.1C246.7 462.1 249.3 463.4 252.3 462.7C255.2 462 257.2 460.1 256.9 458.1C256.6 456.2 253.9 454.9 251 455.2zM316.8 72C178.1 72 72 177.3 72 316C72 426.9 141.8 521.8 241.5 555.2C254.3 557.5 258.8 549.6 258.8 543.1C258.8 536.9 258.5 502.7 258.5 481.7C258.5 481.7 188.5 496.7 173.8 451.9C173.8 451.9 162.4 422.8 146 415.3C146 415.3 123.1 399.6 147.6 399.9C147.6 399.9 172.5 401.9 186.2 425.7C208.1 464.3 244.8 453.2 259.1 446.6C261.4 430.6 267.9 419.5 275.1 412.9C219.2 406.7 162.8 398.6 162.8 302.4C162.8 274.9 170.4 261.1 186.4 243.5C183.8 237 175.3 210.2 189 175.6C209.9 169.1 258 202.6 258 202.6C278 197 299.5 194.1 320.8 194.1C342.1 194.1 363.6 197 383.6 202.6C383.6 202.6 431.7 169 452.6 175.6C466.3 210.3 457.8 237 455.2 243.5C471.2 261.2 481 275 481 302.4C481 398.9 422.1 406.6 366.2 412.9C375.4 420.8 383.2 435.8 383.2 459.3C383.2 493 382.9 534.7 382.9 542.9C382.9 549.4 387.5 557.3 400.2 555C500.2 521.8 568 426.9 568 316C568 177.3 455.5 72 316.8 72zM169.2 416.9C167.9 417.9 168.2 420.2 169.9 422.1C171.5 423.7 173.8 424.4 175.1 423.1C176.4 422.1 176.1 419.8 174.4 417.9C172.8 416.3 170.5 415.6 169.2 416.9zM158.4 408.8C157.7 410.1 158.7 411.7 160.7 412.7C162.3 413.7 164.3 413.4 165 412C165.7 410.7 164.7 409.1 162.7 408.1C160.7 407.5 159.1 407.8 158.4 408.8zM190.8 444.4C189.2 445.7 189.8 448.7 192.1 450.6C194.4 452.9 197.3 453.2 198.6 451.6C199.9 450.3 199.3 447.3 197.3 445.4C195.1 443.1 192.1 442.8 190.8 444.4zM179.4 429.7C177.8 430.7 177.8 433.3 179.4 435.6C181 437.9 183.7 438.9 185 437.9C186.6 436.6 186.6 434 185 431.7C183.6 429.4 181 428.4 179.4 429.7z'/></svg>Github</a>
                                </div>
                            </div>
                            ";
                    }
                ?>
            </div>
            <div class="more">
                <a href="works.php">Voir mes autres projets</a>
            </div>
         </div>
    </div>
    <div id="comp" class="slide">
        <div class="marquee">
            <div class="list">
                <span>
                    <img src="images/tec/html.png" alt="logo html">
                </span>
                <span>
                    <img src="images/tec/css.png" alt="logo css">
                </span>
                <span>
                    <img src="images/tec/figma.png" alt="logo figma">
                </span>
                <span>
                    <img src="images/tec/php.png" alt="logo php">
                </span>
                <span>
                    <img src="images/tec/sass.png" alt="logo sass">
                </span>
                <span>
                    <img src="images/tec/js.png" alt="logo js">
                </span>
    
                <span>
                    <img src="images/tec/html.png" alt="logo html">
                </span>
                <span>
                    <img src="images/tec/css.png" alt="logo css">
                </span>
                <span>
                    <img src="images/tec/figma.png" alt="logo figma">
                </span>
                <span>
                    <img src="images/tec/php.png" alt="logo php">
                </span>
                <span>
                    <img src="images/tec/sass.png" alt="logo sass">
                </span>
                <span>
                    <img src="images/tec/js.png" alt="logo js">
                </span>
            </div>
        </div>
        <div class="marquee2">
            <div class="list">
                <span>
                    <img src="images/tec/js.png" alt="logo js">
                </span>
                <span>
                    <img src="images/tec/sass.png" alt="logo sass">
                </span>
                <span>
                    <img src="images/tec/php.png" alt="logo php">
                </span>
                <span>
                    <img src="images/tec/figma.png" alt="logo figma">
                </span>
                <span>
                    <img src="images/tec/css.png" alt="logo css">
                </span>
                <span>
                    <img src="images/tec/html.png" alt="logo html">
                </span>
                
                <span>
                    <img src="images/tec/js.png" alt="logo js">
                </span>
                <span>
                    <img src="images/tec/sass.png" alt="logo sass">
                </span>
                <span>
                    <img src="images/tec/php.png" alt="logo php">
                </span>
                <span>
                    <img src="images/tec/figma.png" alt="logo figma">
                </span>
                <span>
                    <img src="images/tec/css.png" alt="logo css">
                </span>
                <span>
                    <img src="images/tec/html.png" alt="logo html">
                </span>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>