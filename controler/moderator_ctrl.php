<?php

//j'initialise les tableaux qui contiendrons les valeurs qui status la moderation d'un commentaire puis le role d'un utilisateur
$idState = array(1 => 'Attente', 2 => 'Validé');
$isOk = FALSE;
//si action en parametre URL est == a admin alor j'affiche le tableau administrator
if (isset($_GET['moderator'])) {
    $users = new users();
    $all = $users->getAllUsers();
    $comment = new comments();
    $com = $comment->getAllComments();
    if ($com) {
        $isOk = TRUE;
    }
}
// condition qui permet d'effacer un commentaire du tableau moderateur
if (isset($_POST['delete_comment'])) {
    if (isset($_POST['idComment'])) {
        $comment->id = htmlspecialchars($_POST['idComment']);
        $comment->deleteCommentId();
        header('Location:index.php?moderator=' . $_SESSION['id_ya_role']);
    }
}
// condition qui permet de changer le status d'un commentaire du tableau moderateur
if (isset($_POST['idComment'])) {
    $comment->id_ya_commentstate = htmlspecialchars($_POST['id_ya_commentstate']);
    $comment->id = htmlspecialchars($_POST['idComment']);
    if (isset($_POST['changeState'])) {
        $comment->modifyCommentState();
        header('Location:index.php?moderator=' . $_SESSION['id_ya_role']);
    }
}
?>