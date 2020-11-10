<?php
if (isset($_SESSION['id'])) {
    $token = new users();
    $token->id = $_SESSION['id'];
    $tokenUser = $token->getTokenUser();
}
// Si formconnexion existe je compare et passe aux condition suivantes
if (isset($_POST['formconnexion'])) {
    session_start();
    include_once '../model/config.php';
    include_once '../model/database.php';
    include_once '../model/users_mdl.php';
    $formError = array();
    $success = array();
    $user = new users();
    $user->mailconnect = htmlspecialchars($_POST['mailconnect']);
    $passconnect = htmlspecialchars($_POST['passconnect']);
    // si mes champs de connexion sont different de vide alor je passe a la derniére condition       
    if (!empty($user->mailconnect) AND ! empty($passconnect)) {
        $pass = $user->getUserMail();
        if (is_object($pass)) {
            // si password_verify compare les donnees POST aux donnees en base et retourne true 
            if (password_verify($passconnect, $pass->pass)) {
                // alor j'instancie ma variable de session
                $_SESSION['id'] = $pass->id;
                $_SESSION['id_ya_role'] = $pass->id_ya_role;
                $token = $user->generateCSRFToken();
                $user->id = $_SESSION['id'];
                $user->tokenUser = $token;
                $user->updateToken();
                $success['type'] = 'Success';
                $success['url'] = 'index.php?id=' . $_SESSION['id'].'&userToken='.$token;
                // j'affiche mon message de success encoder en JSON afin d'être recuperer par la method ajax
                echo json_encode($success);
            }
        }
    }
}
?>