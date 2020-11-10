<?php

if (isset($_SESSION['id'])) {
    $token = new users();
    $token->id = $_SESSION['id'];
    $tokenUser = $token->getTokenUser();
}
//Appel AJAX pour verifier le mail.
if (isset($_POST['mailConfirm'])) {
    include '../model/config.php';
    include '../model/database.php';
    include '../model/users_mdl.php';
    $user = new users();
    $user->mail = htmlspecialchars($_POST['mailConfirm']);
    echo $user->checkFreeMail();
}
if (isset($_POST['confirmMail'])) {
    if ($_POST['confirmMail'] === $_POST['mailConfirm']) {
        echo TRUE;
    } else {
        echo FALSE;
    }
} else {
    if (isset($_POST['modifyMail'])) {
        if (!empty($_POST['mail1']) && !empty($_POST['mail2'])) {
            if ($_POST['mail1'] == $_POST['mail2']) {
                $user = new users();
                $user->id = $_SESSION['id'];
                $user->mail = htmlspecialchars($_POST['mail1']);
                if (filter_var($_POST['mail1'], FILTER_VALIDATE_EMAIL)) {
                    $user->updateMailId();
                    $formError['successMail'] = 'Votre adresse mail a été changer avec succès.';
                } else {
                    $formError['modifMail'] = 'Veuillez entrer une adresse mail valide';
                }
            } else {
                $formError['modifMail'] = 'Vos adresses mails ne correspondent pas';
            }
        } else {
            $formError['modifMail'] = 'Vérifiez que tous les champs soient remplis';
        }
    }
}
?>

