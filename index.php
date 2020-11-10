<?php
header('X-XSS-Protection: 0');
// Suppression du fichier cookie
setcookie('cookiewarning', '', time() - 3600, '/');
// Suppression de la valeur du cookie en mémoire dans $_COOKIE
unset($_COOKIE['cookiewarning']);
$tokenUser = '';
//header
session_start();
include 'model/config.php';
include 'model/database.php';
include 'model/flashContent_mdl.php';
include 'model/users_mdl.php';
include 'model/comments_mdl.php';
include 'view/head.php';
include 'controler/connect_ctrl.php';
include 'controler/passlost_ctrl.php';
include 'controler/view_ctrl.php';
include 'view/nav.php';
//condition qui selectionne mon body
if (isset($_GET['id'])) {
    if (isset($_POST['buy']) && $_POST['buy'] == 'payer') {
        include 'controler/buy_ctrl.php';
    }
    include 'controler/profil_ctrl.php';
    include 'view/headerProfil.php';
    include 'view/contentProfil.php';
} else if (isset($_GET['passlost'])) {
    include 'view/passlost.php';
} else if (isset($_GET['conditions'])) {
    include 'view/conditions.php';
} else if (isset($_GET['admin'])) {
    include 'controler/admin_ctrl.php';
    include 'view/admin.php';
} else if (isset($_GET['moderator'])) {
    include 'controler/moderator_ctrl.php';
    include 'view/moderator.php';
} else if (isset($_GET['comment'])) {
    include 'controler/comment_ctrl.php';
    include 'view/comment.php';
} else if (isset($_GET['modifPass'])) {
    include 'controler/modifPass_ctrl.php';
    include 'view/modifPass.php';
} else if (isset($_GET['paypal']) && $_GET['paypal'] == 'buy') {
    include 'view/paypal.php';
}  else if (isset($_GET['success']) && $_GET['success'] == 'paypal') {
    $success = true;
    $id = $_SESSION['id'];
    $paypal = new users();
    $paypal->success = $success;
    $paypal->id = $id;
    $paypal->updatePaypal();
    echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'";</script>';
}  else if (isset($_GET['success']) && $_GET['success'] == 'com') {
    include 'view/success.php';
}else if (isset($_GET['modifMail'])) {
    include 'controler/modifMail_ctrl.php';
    include 'view/modifMail.php';
} else if (isset($_GET['contact'])) {
    include 'controler/mail_ctrl.php';
    include 'view/contact.php';
} else {
    include 'controler/addUser_ctrl.php';
    include 'view/header.php';
    include 'view/content.php';
}
//footer
include 'view/footer.php';
?>

