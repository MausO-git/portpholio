<?php
session_start();

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: index.php?error=4"); // si on accède direct au fichier
    exit;
}

if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    header("Location: index.php?error=csrf");
    exit;
}
unset($_SESSION['token']); // invalider le token après usage


// Récupération et sécurisation des champs
$nom     = htmlspecialchars(trim($_POST['nom']));
$prenom  = htmlspecialchars(trim($_POST['prenom']));
$email   = htmlspecialchars(trim($_POST['email']));
$message = htmlspecialchars(trim($_POST['message']));

// Vérification des champs obligatoires
if (empty($nom) || empty($prenom) || empty($email) || empty($message)) {
    header("Location: index.php?error=1"); // erreur si un champ est vide
    exit;
}

// Vérification adresse mail valide
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=2"); // erreur email invalide
    exit;
}

// Destinataire
$to = "contact@mausosc.com";

// Sujet du mail
$subject = "Nouveau message depuis le formulaire de contact";

// Corps du mail
$body = "Vous avez reçu un nouveau message via votre site :\n\n";
$body .= "Nom : " . $nom . "\n";
$body .= "Prénom : " . $prenom . "\n";
$body .= "Email : " . $email . "\n\n";
$body .= "Message : \n" . $message . "\n";

// Entêtes
$headers = "From: ".$email."\r\n";
$headers .= "Reply-To: ".$email."\r\n";

// Envoi
if (mail($to, $subject, $body, $headers)) {
    header("Location: index.php?sent=success");
    exit;
} else {
    header("Location: index.php?error=3"); // erreur d'envoi
    exit;
}