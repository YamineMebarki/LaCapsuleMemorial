<?php

if (isset($_SESSION['id'])) {
    $token = new users();
    $token->id = $_SESSION['id'];
    $tokenUser = $token->getTokenUser();
}
if (isset($_POST['testConfirm'])) {
    if ($_POST['testConfirm'] === $_POST['confirmTest']) {
        echo TRUE;
    } else {
        echo FALSE;
    }
} else {
    if (isset($_POST['modifyPass'])) {
        if (!empty($_POST['pass1']) && !empty($_POST['pass2'])) {
            if ($_POST['pass1'] == $_POST['pass2']) {
                $user = new users();
                $user->id = $_SESSION['id'];
                $user->pass = password_hash($_POST['pass1'], PASSWORD_BCRYPT);
                $user->updatePassId();
                $formError['successPass'] = 'Votre mot de pass a été changer avec succès.';
            
            $user = new users();
            $token = $user->generateCSRFToken();
            $user->id = $_SESSION['id'];
            $user->tokenUser = $token;
            $user->updateToken();
    echo '<meta http-equiv="refresh" content="5;url=http://lacapsulememorial.fr/index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'" />';
            } else {
                $formError['modifPass'] = 'Vos mots de passe ne correspondent pas';
            }
        } else {
            $formError['modifPass'] = 'Veuillez remplir tous les champs';
        }
    }
}
?>

