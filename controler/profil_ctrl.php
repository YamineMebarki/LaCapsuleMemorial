<?php
$stateView = array(1 => 'Public', 2 => 'Privé');
$paypal = new users();
$paypal->id = $_SESSION['id'];
$success = $paypal->getPaypal();
if (isset($_GET['id'])) {
    $formError = array();
    $isUser = FALSE;
    $user = new users();
    $flash = new flashContent();
    $flash->id_ya_users = $_GET['id'];
    $flashInfo = $flash->getFlashContentId();
    if ($flashInfo->state == 1 || isset($_SESSION) && !empty($_SESSION)) {
        $isUser = TRUE;
    } else {
        echo '<script>window.location.href="error-404.php?error";</script>';
    }
} else if (isset($_SESSION['id'])) {
    $formError = array();
    $isUser = FALSE;
    $user = new users();
    $flash = new flashContent();
    $flash->id_ya_users = $_SESSION['id'];
    $flashInfo = $flash->getFlashContentId();
    if ($flashInfo) {
        $isUser = TRUE;
    } else {
        echo '<script>window.location.href="error-404.php?error";</script>';
    }
}
// Recupere mon image puis la redirige afin de la stocker dans mon dossier avatar
if (isset($_POST["validAvatar"]) && isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
    // Initalisation d'une variable qui stockera la taille du poid autoriser pour l'avatar 2mo
    $tailleMax = 10097152;
    // Déclaration d'une variable qui stockera les extension autoriser pour l'avatar
    $extensionValid = array('jpg', 'jpeg', 'gif', 'png');
    // Condition qui s'effectue si le poid de mon image est inferieur ou egal a ma limite autoriser
    if ($_FILES['photo']['size'] <= $tailleMax) {
        // Declaration d'une variable qui sotkera l'extension de mon image tout en la mettant en miniscule et on ignore le caractere . puis on recupere le nom de l'extension apres le caractere ignorer
        $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
        // Condition qui verifie si l'extesion récuperer est egal a notre tableau d'extension
        if (in_array($extensionUpload, $extensionValid)) {
            $flash->extensionUpload = $extensionUpload;
            // J'initialise une variable qui stocke le chemin que je definie ou sera stoker mon avatar 
            $way = 'avatar/images' . $_GET['id'] . '.' . $flash->extensionUpload;
            //Déclaration d'une variable qui stokera la valeur de retour du Deplacement d'un fichier téléchargé renvoi TRUE ou FALSE
            $result = move_uploaded_file($_FILES['photo']['tmp_name'], $way);
            if ($result) {
                $flash->id_ya_users = $_SESSION['id'];
                $flash->photo = 'images' . $_SESSION['id'] . '.' . $flash->extensionUpload;
                // Method qui update mon avatar en base de donnees
                $flash->UpdateAvatar();
                echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$tokenUser.'";</script>';
            } else {
                $formError['photo'] = 'Désoler une erreur c\'est produite , veuillez charger une autre image';
            }
        } else {
            $formError['photo'] = 'votre format de photo ne correspond pas il doit être au format jpg, jpeg, gif ou png';
        }
    } else {
        $formError['photo'] = 'votre photo ne doit pas depasser 10mo';
    }
}
// Recupere mon image puis la redirige afin de la stocker dans mon album photo
if (isset($_POST["validphoto"]) && isset($_FILES['picture']) && !empty($_FILES['picture']['name'])) {
    // Initalisation d'une variable qui stockera la taille du poid autoriser pour l'avatar 2mo
    $tailleMax = 20097152;
    // Déclaration d'une variable qui stockera les extension autoriser pour l'avatar
    $extensionValid = array('jpg', 'jpeg', 'gif', 'png', 'mp4');
    // Condition qui s'effectue si le poid de mon image est inferieur ou egal a ma limite autoriser
    if ($_FILES['picture']['size'] <= $tailleMax) {
        // Declaration d'une variable qui sotkera l'extension de mon image tout en la mettant en miniscule et on ignore le caractere . puis on recupere le nom de l'extension apres le caractere ignorer
        $extensionUpload = strtolower(substr(strrchr($_FILES['picture']['name'], '.'), 1));
        // Condition qui verifie si l'extesion récuperer est egal a notre tableau d'extension
        if (in_array($extensionUpload, $extensionValid)) {
            // J'initialise une variable qui stocke le chemin que je definie ou sera stoker mon avatar 
            $way = 'album_photo'.$_SESSION['id'].'/'.$_FILES['picture']['name'];
            //Déclaration d'une variable qui stokera la valeur de retour du Deplacement d'un fichier téléchargé renvoi TRUE ou FALSE
            $result = move_uploaded_file($_FILES['picture']['tmp_name'], $way);
            if ($result) {
                echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$tokenUser.'";</script>';
            } else {
                $formError['picture'] = 'erreur lors du deplacements de votre photo';
            }
        } else {
            $formError['picture'] = 'votre format de photo ne correspond pas il doit être au format jpg, jpeg, gif ou png';
        }
    } else {
        $formError['picture'] = 'votre photo ne doit pas depasser 10mo';
    }
}
// condition qui permet de changer le status d'une vue de memorial
if (isset($_POST['changeStateView'])) {
    $flash->state = htmlspecialchars($_POST['id_ya_state']);
    $flash->id = $_SESSION['id'];
    $flash->modifyStateView();
   echo '<script>document.location = "index.php?id='. $_SESSION['id'].'"</script>';
}
//Method qui permet d'effacer une picture
if(isset($_POST['deletePicture'])){
    $directory = 'album_photo' . $_SESSION['id'];
    $fichier = htmlspecialchars($_POST['picture']);
    $way = $directory . '/' . $fichier ;
    //fucntion php qui supprime le fichier du chemin renseigner
    unlink($way);
    $user = new users();
    $token = $user->generateCSRFToken();
    $user->id = $_SESSION['id'];
    $user->tokenUser = $token;
    $user->updateToken();
    header('Location: index.php?id=' . $_SESSION['id'].'&userToken='.$token);
}
//Method qui supprime mon compte user
if (isset($_POST['delete_user'])) {
    $user = new users();
    $way = 'avatar/' . $flashInfo->avatar;
    //fucntion php qui supprime le fichier du chemin renseigner 
    unlink($way);
    $dossier = 'album_photo'.$_SESSION['id'];
    $dir_iterator = new RecursiveDirectoryIterator($dossier);
    $iterator = new RecursiveIteratorIterator($dir_iterator, RecursiveIteratorIterator::CHILD_FIRST);

// On supprime chaque dossier et chaque fichier	du dossier cible
    foreach($iterator as $fichier){
        $fichier->isDir() ? rmdir($fichier) : unlink($fichier);
    }

// On supprime le dossier cible
    rmdir($dossier);
    $user->id = $_SESSION['id'];
    $userInfo = $user->getUserId();
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
    $_SESSION = array();
    session_destroy();
    echo '<script>window.location.href="index.php";</script>';
    if ($user) {
        $isUser = TRUE;
    }
}
//Method qui supprime mon avatar en base de donnees puis dans le dossier source.
if (isset($_POST['delete_avatar'])) {
    if (isset($_POST['avatar'])) {
        $img = htmlspecialchars($_POST['avatar']);
        $way = 'avatar/' . $img;
        //fucntion php qui supprime le fichier du chemin renseigner 
        unlink($way);
        $flash->id_ya_users = $_SESSION['id'];
        $flash->photo = 'defaut.jpg';
        $flash->deleteAvatar();
        $user = new users();
        $token = $user->generateCSRFToken();
        $user->id = $_SESSION['id'];
        $user->tokenUser = $token;
        $user->updateToken();
        echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'";</script>';
        if ($flash) {
            $isUser = TRUE;
        }
    }
}
//Method qui insert un contenu profil editer.
if (isset($_POST['register'])) {
    $flash->id_ya_users = $_SESSION['id'];
    $flash->content = htmlspecialchars($_POST['biography']);
    $flash->insertContent();
    $user = new users();
    $token = $user->generateCSRFToken();
    $user->id = $_SESSION['id'];
    $user->tokenUser = $token;
    $user->updateToken();
    echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'";</script>';
    if ($flash) {
        $isUser = TRUE;
    }
}
//Method qui met à jour le contenu profil editer.
if (isset($_POST['update'])) {
    $flash->id_ya_users = $_SESSION['id'];
    $flash->content = htmlspecialchars($_POST['biography']);
    $flash->updateContent();
    $user = new users();
    $token = $user->generateCSRFToken();
    $user->id = $_SESSION['id'];
    $user->tokenUser = $token;
    $user->updateToken();
    echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'";</script>';
    if ($flash) {
        $isUser = TRUE;
    }
}
// Supprime le contenu editer.
if (isset($_POST['deleteContent'])) {
    $flash->id_ya_users = $_SESSION['id'];
    $flash->content = '';
    $flash->deleteContent();
    $user = new users();
    $token = $user->generateCSRFToken();
    $user->id = $_SESSION['id'];
    $user->tokenUser = $token;
    $user->updateToken();
    echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'";</script>';
    if ($flash) {
        $isUser = TRUE;
    }
}
// Test du mail en AJAX afin de changer son mot de passe.
if (isset($_POST['passTest'])) {
    // J'include les models nécéssaire au bon fonctionnement du script seul
    include_once '../model/config.php';
    include_once '../model/database.php';
    include_once '../model/users_mdl.php';
    // Instanciation de la class users
    $user = new users();
    $user->id = $_POST['userId'];
    $userInfo = $user->getUserId();
    $pass = password_verify(htmlspecialchars($_POST['passTest']), $userInfo->pass);
    // valeur HXR retourner à AJAX
    echo $pass;
} else if (isset($_POST['prevalidPass'])) {// au submit si passTest renvoi TRUE 1 alor redirection sinon messages d'erreurs
    $user = new users();
    $user->id = $_SESSION['id'];
    $userInfo = $user->getUserId();
    if (!empty($_POST['oldPass'])) {
        if (password_verify($_POST['oldPass'], $userInfo->pass)) {
            $token = $user->generateCSRFToken();
            $user->id = $_SESSION['id'];
            $user->tokenUser = $token;
            $user->updateToken();
            echo '<script>window.location.href="index.php?modifPass=' . $token .'";</script>';
        } else {
            $formError['modifPass'] = 'Le mot de pass renseigner n\'est pas valide';
        }
    } else {
        $formError['modifPass'] = 'Merci de renseigner le champ vide';
    }
}
// Test du mail en AJAX afin de changer son mail.
if (isset($_POST['changeMail'])) {
    include_once '../model/config.php';
    include_once '../model/database.php';
    include_once '../model/users_mdl.php';
    $user = new users();
    $user->id = $_POST['userId'];
    $userInfo = $user->getUserId();
    if ($_POST['changeMail'] == $userInfo->mail) {
        $mail = 1;
        echo $mail;
    } else {
        $mail = 0;
        echo $mail;
    }
} else if (isset($_POST['prevalidMail'])) {// au submit si passTest renvoi TRUE 1 alor redirection sinon messages d'erreurs
    $user = new users();
    $user->id = $_GET['id'];
    $userInfo = $user->getUserId();
    if (!empty($_POST['oldMail'])) {
        if ($_POST['oldMail'] == $userInfo->mail) {
            $token = $user->generateCSRFToken();
            $user->id = $_SESSION['id'];
            $user->tokenUser = $token;
            $user->updateToken();
            ob_start();
            echo '<script>window.location.href="index.php?modifMail=' . $token .'";</script>';
        } else {
            $formError['modifMail'] = 'L\'adresse mail renseigner n\'est pas valide';
        }
    } else {
        $formError['modifMail'] = 'Merci de renseigner le champ vide';
    }
}
if (isset($_GET['admin'])) {
    // Pour l'admin method qui permet de recuperer le status des commentaires 
    $comment = new comments();
    $comment->id_ya_comments = htmlspecialchars(isset($_GET['comment']));
    $state = $comment->getStateComment();
}
// commentaire //
if (isset($_GET['id'])) {
    $comment = new comments();
    $comment->id_ya_users = $_GET['id'];
    // Permet de recuperer tous les commentaires d'un user 
    $com = $comment->getAllCommentsUser();
}
// Permet d'enregistrer un commentaire
if (isset($_POST['registerComment'])) {
    $comment = new comments();
    if (!empty($_POST['username'])) {
        $comment->username = htmlspecialchars($_POST['username']);
        if (!empty($_POST['comment'])) {
            $comment->comments = htmlspecialchars($_POST['comment']);
            $comment->id_ya_users = $_GET['id'];
            $comment->id_ya_flashcontent = $_GET['id'];
            $comment->insertComment();
            echo '<script>document.location.href = "index.php?success=com";</script>';
        } else {
            $formError['comment'] = 'Veuillez écrire un commentaire';
        }
    } else {
        $formError['username'] = 'Veuillez renseigner un pseudo';
    }
}
// Permet d'effacer un commentaire
if (isset($_POST['deleteComment'])) {
    $comment = new comments();
    $comment->id = $_POST['commentId'];
    $comment->deleteCommentId();
    $user = new users();
    $token = $user->generateCSRFToken();
    $user->id = $_SESSION['id'];
    $user->tokenUser = $token;
    $user->updateToken();
    echo '<script>window.location.href="index.php?id=' . $_SESSION['id'] .'&userToken='.$token.'";</script>';
}
// Permet de mettre a jour un commentaire
if (isset($_POST['updateComment'])) {
    $comment = new comments();
    $comment->id = $_GET['id'];
    $comment->comments = htmlspecialchars($_POST['comment']);
    $comment->updateCommentId();
}
?>
