<?php

$use = new users();
$nbUsers = $use->countUsers();
//j'initialise les tableaux qui contiendrons les valeurs qui status la moderation d'un commentaire puis le role d'un utilisateur
$idRole = array(3 => 'User', 2 => 'Moderator');
$isOk = FALSE;
//si action en parametre URL est == a admin alor j'affiche le tableau administrator
if (isset($_GET['admin']) && isset($_SESSION['id_ya_role']) == 35) {
    $users = new users();
    $all = $users->getAllUsers();
    $comment = new comments();
    $comment->id_ya_users = isset($_SESSION['id']);
    $com = $comment->getAllComments();
    $comment->id_ya_comments = htmlspecialchars(isset($_GET['comment']));
    $state = $comment->getStateComment();
    if ($all) {
        $isOk = TRUE;
    }
}
// condition qui permet d'effacer un user du tableau administrator
if (isset($_POST['delete_profil'])) {
    if (isset($_POST['idUser'])) {
    $user = new users();
    $user->id = htmlspecialchars($_POST['idUser']);
    $userInfo = $user->getUserId();
    $way = 'avatar/' . $flashInfo->avatar;
    //fucntion php qui supprime le fichier du chemin renseigner 
    unlink($way);
    $dossier = 'album_photo'.$userInfo->id;
    $dir_iterator = new RecursiveDirectoryIterator($dossier);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);

// On supprime chaque dossier et chaque fichier	du dossier cible
foreach($iterator as $fichier){
    $fichier->isDir() ? rmdir($fichier) : unlink($fichier);
}

// On supprime le dossier cible
rmdir($dossier);
            $headers = "MIME-Version: 1.0\r\n";
            //header mail avec ces paramêtres
            //Adresse d'expedition
            $headers .= 'From:lacapsulememorial@gmail.com' . "\n";
            // formats de codage UTF-8
            $headers .= 'Content-Type:text/html; charset=utf-8' . "\n";
            // formats de codage afin de transférer des données binaires
            $headers .= 'Content-Transfer-Encoding: 8bit';
            // Contenu du mail 
            $message = '<html>'
                    . '<body>'
                    . '<div class="text-success">Votre Compte a été supprimé avec succès !</div>'
                    . '<div>Merci d\'avoir utilisée lacapsule</div>'
                    . '</body>'
                    . '</html>';
            //function qui envoie un mail avec les identifiants de l'utilisateur
            mail($userInfo->mail, "Confirmation de compte", $message, $headers);
            $user->deleteUser();
            echo '<script>window.location.href="index.php?admin=35";</script>';
    }
}
// condition qui permet de changer le role d'un user du tableau administrator
if (isset($_POST['changeRole'])) {
    if (isset($_POST['idUser'])) {
        $users->id_ya_role = htmlspecialchars($_POST['id_ya_role']);
        $users->id = htmlspecialchars($_POST['idUser']);
        $users->modifyRole();
        header('Location:index.php?admin=' . $_SESSION['id']);
    }
}