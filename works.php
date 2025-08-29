<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/style.css">
    <title>Travaux</title>
</head>
<body>
    <?php
        include("partials/header.php");
        include('partials/contact.php');
    ?>
    <div class="slide" id="works">

    </div>
    <div class="backTop">
        <img src="images/light_pxarrow_up.png" alt="flèche du haut en pixel">
    </div>
    <?php
        include("partials/footer.php")
    ?>
    
    <script src="js/works.js"></script>
</body>
</html>