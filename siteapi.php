<?php
    session_start();

    $parp = 4;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    $offset = ($page -1) * $parp;

    require("connexion.php");
    $req = $bdd->prepare("SELECT w.images AS wimg, w.nom AS nom, DATE_FORMAT(w.date, '%d/%m/%Y') AS euDate, w.descr AS descr,w.link AS link, w.github AS github, w.figma AS figma,t1.img AS img1, t2.img AS img2, t3.img AS img3 
                    FROM work w
                    INNER JOIN link_tw l ON w.id = l.id_work
                    LEFT JOIN tec t1 ON l.tec1 = t1.id
                    LEFT JOIN tec t2 ON l.tec2 = t2.id
                    LEFT JOIN tec t3 ON l.tec3 = t3.id
                    ORDER BY date DESC LIMIT :offset,:parp");
    $req->bindValue(':offset', $offset, PDO::PARAM_INT);
    $req->bindValue(':parp', $parp, PDO::PARAM_INT);
    $req->execute();

    while($don = $req->fetch(PDO::FETCH_ASSOC)){
        echo "
            <div class='site'>
                <h1 class='siteName'>".$don['nom']."</h1>
                <div class='cover'>
                    <img src='images/site/".$don['wimg']."' alt='image repésentant le site ".$don['nom']."'>
                </div>
                <div class='desc'>
                    <h2>Description</h2>
                    <p>".$don['descr']."</p>
                </div>
                <div class='date'>".$don['euDate']."</div>
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
        echo   "</div>
                <div class='blocLien'>
                    <div class='lien'>
                        <a href='".$don['link']."'>Voir le site</a>
                    </div>
                    <div class='git'>
                        <a href='".$don['github']."'>Github</a>
                    </div>";
            if(isset($don['figma'])){
                echo "
                    <div class='figma'>
                        <a href='".$don['figma']."'>Voir la maquette</a>
                    </div>
                ";
            }
        echo   "</div>
            </div>
        ";
    };

?>

