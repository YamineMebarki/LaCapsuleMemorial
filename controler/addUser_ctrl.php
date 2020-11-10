<?php

//function generique qui securise mes POST
function secur($data) {
    $data = trim($data); // Supprime les espaces
    $data = stripslashes($data); // Supprime les antislashs d'une chaîne
    $data = strip_tags($data); // Supprime les balises HTML et PHP d'une chaîne
    return $data;
}

// function generique qui formate les donnees en minuscule 
function lowerCase($string) {
    $string = strtolower($string);
    return $string;
}

// function generique qui formate les donnees en majuscule
function upperCase($string) {
    $string = strtoupper($string);
    return $string;
}

//Appel AJAX pour verifier le mail.
if (isset($_POST['mailTest'])) {
    include '../model/config.php';
    include '../model/database.php';
    include '../model/users_mdl.php';
    $user = new users();
    $user->mail = secur($_POST['mailTest']);
    echo $user->checkFreeMail();
} else { //Validation du formulaire
//j'instancie ma class users    
    $user = new users();
//J'initialise mon tableau d'erreur.
    $formError = array();
//On initialise les variables de stockage des informations pour éviter d'avoir des erreurs dans la vue.
    $lastname = '';
    $firstname = '';
    $mail = '';
//si valider existe alor.
    if (isset($_POST['valider'])) {
        // je verifie si mes poste son different de vide 
        if (!empty($_POST['lastname'])) {
            $lastname = secur(upperCase($_POST['lastname']));
        } else {
            $formError['lastname'] = 'Veuillez renseigner votre nom';
        }
        if (!empty($_POST['firstname'])) {
            $firstname = secur(lowerCase($_POST['firstname']));
        } else {
            $formError['firstname'] = 'Veuillez renseigner votre prenom';
        }
        //On vérifie que l'adresse mail est renseigné, qu'il correspond à la confirmation et qu'il a la bonne forme.
        if (!empty($_POST['mail1']) && !empty($_POST['mail2'])) {
            if ($_POST['mail1'] == $_POST['mail2']) {
                if (filter_var($_POST['mail1'], FILTER_VALIDATE_EMAIL)) {
                    $user->mail = $_POST['mail1'];
                    if ($user->verifyMail() == 0) {
                        $mail = secur($_POST['mail1']);
                    } else {
                        $formError['mail'] = 'Un compte existe déjà pour cette adresse mail !';
                    }
                } else {
                    $formError['mail'] = 'L\'adresse mail n\'est pas valide';
                }
            } else {
                $formError['mail'] = 'Les adresses mails ne correspondent pas';
            }
        } else {
            $formError['mail'] = 'Veuillez renseigner une adresse mail';
        }
        //Si il n'y a pas d'erreur, j'enregistre l'utilisateur
        if (count($formError) == 0) {
            $formSuccess = array();
            //Création d'un pass qui sera hasher avant d'être inserer en base de données
            $pass = $user->generateCSRFtoken();
            $user->pass = password_hash($pass, PASSWORD_BCRYPT);
            $user->mail = $mail;
            $user->lastname = $lastname;
            $user->firstname = $firstname;
            $user->id_ya_role = 3;
            $user->addUser();
            $user->mailconnect = $user->mail;
            $use = $user->getUserMail();
            $flash = new flashContent();
            $flash->id_ya_users = (int) $use->id;
            $flash->qrCode = 'https://chart.googleapis.com/chart?cht=qr&chl=http://www.lacapsulememorial.fr?index.php?id=' . $flash->id_ya_users . '&chs=350';
            $flash->insertQr();
            $flash->id_ya_users = (int) $use->id;
            $flash->photo = 'defaut.jpg';
            $flash->updateAvatar();
            $dossier = 'album_photo' . $use->id;
            if (!is_dir($dossier)) {
                mkdir($dossier);
            }
            $formSuccess['success'] = 'Votre compte a bien été créé !';
            $formSuccess['courriel'] = 'Un mail avec vos identifiants vient de vous être envoyé, penssez à consulter vos courriels indésirables.';
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
                . '<style>'
                .'success {'
                .'color: green;'
                .'}'
                .'center {'
                .'text-align: center;'
                .'}'
                .'warning {'
                .'color: red;'
                .'}'
                .'</style>'
                . '<body>'
                . '<div class="success center"><h1>Votre Compte a été créé avec succès !</h1></div>'
                . '<div class="center">Adresse de connexion : <h2><b>' . $mail . '</b></h2></div>'
                . '<div class="center">Votre mot de passe : <h2 class="success">' . $pass . '</h2></div>'
                . '<div class="warning center"><h3>Penssez à modifier votre mot de passe depuis votre profil->menu->paramêtres->modifier mon mot de passe.</h3></div>'
                . '<div class="center"><a href="' . $flash->qrCode . '"><h4>lien vers votre Qr-Code qui redirige vers votre profil.</h4></a></div>'
                . '<div class="center">Ce Qr-code peut être graver sur tout types de supports.</div>'
                .'<div class="center"><a href="https://play.google.com/store">Rendez-vous sur le playStore afin d\'y télécharger votre lecteur de Qr-code !</a></div>'
                . '</body>'
                . '</html>';
            //function qui envoie un mail avec les identifiants de l'utilisateur
            mail($mail, "Confirmation de compte", $message, $headers);
        }
    }
}
?>

