<?php

$formError = array();
$formSuccess = array();
if (isset($_POST['action']) && $_POST['action'] == 'envoyer') {
    // tableau d'erreur 
    if (!empty($_POST['to']) && filter_var($_POST['to'], FILTER_VALIDATE_EMAIL) && isset($_POST['to'])) {
        $to = htmlspecialchars($_POST['to']);
    } else {
        $formError['to'] = 'Votre mail n\' est pas valide';
    }
    if (!empty($_POST['subject']) && isset($_POST['subject'])) {
        $subject = htmlspecialchars($_POST['subject']);
    } else {
        $formError['subject'] = 'Veuillez renseigné un pseudo';
    }
    if (!empty($_POST['message']) && isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
    } else {
        $formError['message'] = 'Veuiller écrire un message';
    }
    if (empty($formError)) {
        $headers = "MIME-Version: 1.0\r\n";
//header mail avec ces paramêtres
        $headers = "From: $to" . PHP_EOL;
        $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
        mail("lacapsulememorial@gmail.com", $subject, $message, $headers);
        $formSuccess['success'] = 'Email envoyé avec succès !';
    } else {
        $formError['error'] = "Erreur lors de l'envoi de l'email :(";
    }
}
?>