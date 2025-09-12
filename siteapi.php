<?php
    session_start();

    $parp = 4;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $offset = ($page -1) * $parp;

    require("connexion.php");

    $total = $bdd->query("SELECT COUNT(*) FROM work")->fetchColumn();
    $nb = intval(ceil($total / $parp));

    echo "
        <div class='selecButton'>
            <div class='pre'";
            if((int)$_GET['page'] === 1){
                echo "data-grey='1'";
            }
            echo "><img src='images/light_pxarrow_left.png' alt='flèche gauche en pixel'></div>";
        for($i = 1; $i <= $nb; $i++){
            echo "<div class='pageButton' ";
            if((int)$_GET['page'] === $i){
                echo "data-select='1'";
            }
            echo ">".$i."</div>";
        }
    echo   "<div class='next'";
            if((int)$_GET['page'] === $nb){
                echo "data-grey='1'";
            }
            echo "><img src='images/light_pxarrow_right.png' alt='flèche droite en pixel'></div>
        </div>
        ";


    $req = $bdd->prepare("SELECT DISTINCT w.images AS wimg, w.nom AS nom, DATE_FORMAT(w.date, '%d/%m/%Y') AS euDate, w.descr AS descr,w.link AS link, w.github AS github, w.figma AS figma,t1.img AS img1, t2.img AS img2, t3.img AS img3 
                    FROM work w
                    INNER JOIN link_tw l ON w.id = l.id_work
                    LEFT JOIN tec t1 ON l.tec1 = t1.id
                    LEFT JOIN tec t2 ON l.tec2 = t2.id
                    LEFT JOIN tec t3 ON l.tec3 = t3.id
                    ORDER BY date DESC LIMIT :offset,:parp");
    $req->bindValue(':offset', $offset, PDO::PARAM_INT);
    $req->bindValue(':parp', $parp, PDO::PARAM_INT);
    $req->execute();

    $compt = 1;

    while($don = $req->fetch(PDO::FETCH_ASSOC)){
        echo "
            <div class='site ";
            if($compt % 2 === 0){
                echo "right";
            }else{
                echo "left";
            }
            echo "'>
                <div class='bloc1'>
                    <h1 class='siteName'>".$don['nom']."</h1>
                    <div class='cover'>
                        <img src='images/site/".$don['wimg']."' alt='image repésentant le site ".$don['nom']."'>
                    </div>
                    <div class='grTec'>
                        <h3>Techniques principales</h3>
                        <div class='tec'>";
                        if(isset($don['img1'])){
                            echo "<img src='images/tec/".$don['img1']."' alt='logo de la tec1'>";
                        }
                        if(isset($don['img2'])){
                            echo "<img src='images/tec/".$don['img2']."' alt='logo de la tec2'>"; 
                        }
                        if(isset($don['img3'])){
                            echo "<img src='images/tec/".$don['img3']."' alt='logo de la tec3'>";
                        }
            echo       "</div>
                    </div>
                </div>
                <div class='bloc2'>
                    <div class='desc'>
                        <p>".$don['descr']."</p>
                    </div>
                    <div class='date'>Mis en ligne le : <span>".$don['euDate']."</span></div>
                    <div class='blocLien'>
                        <div class='lien'>
                            <a href='".$don['link']."' target='_blank'><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'><!--!Font Awesome Free v7.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill='#000000' d='M415.9 344L225 344C227.9 408.5 242.2 467.9 262.5 511.4C273.9 535.9 286.2 553.2 297.6 563.8C308.8 574.3 316.5 576 320.5 576C324.5 576 332.2 574.3 343.4 563.8C354.8 553.2 367.1 535.8 378.5 511.4C398.8 467.9 413.1 408.5 416 344zM224.9 296L415.8 296C413 231.5 398.7 172.1 378.4 128.6C367 104.2 354.7 86.8 343.3 76.2C332.1 65.7 324.4 64 320.4 64C316.4 64 308.7 65.7 297.5 76.2C286.1 86.8 273.8 104.2 262.4 128.6C242.1 172.1 227.8 231.5 224.9 296zM176.9 296C180.4 210.4 202.5 130.9 234.8 78.7C142.7 111.3 74.9 195.2 65.5 296L176.9 296zM65.5 344C74.9 444.8 142.7 528.7 234.8 561.3C202.5 509.1 180.4 429.6 176.9 344L65.5 344zM463.9 344C460.4 429.6 438.3 509.1 406 561.3C498.1 528.6 565.9 444.8 575.3 344L463.9 344zM575.3 296C565.9 195.2 498.1 111.3 406 78.7C438.3 130.9 460.4 210.4 463.9 296L575.3 296z'/></svg>Voir le site</a>
                        </div>
                        <div class='lien'>
                            <a href='".$don['github']."' target='_blank'><img src='images/pxgit_black.png'>Github</a>
                        </div>";
                if(isset($don['figma'])){
                    echo "
                        <div class='lien'>
                            <a href='".$don['figma']."' target='_blank'>Voir la maquette</a>
                        </div>
                    ";
                }
            echo   "</div>
                </div>
            </div>
        ";
        $compt++;
    };

    $req->closeCursor();
?>

