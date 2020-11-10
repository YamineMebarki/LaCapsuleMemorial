<?php
if(isset($_POST['newPass'])){
    $formError = array();
    $formSuccess = array();
    if (!empty($_POST['passlost']) && filter_var($_POST['passlost'], FILTER_VALIDATE_EMAIL) && isset($_POST['passlost'])) {
        $mail = htmlspecialchars($_POST['passlost']);
    } else {
        $formError['passlost'] = 'Veuillez communiquer une adresse mail valide';
    }
    if (empty($formError)) {
        $user = new users();
//    //Création d'un pass qui sera hasher avant d'être inserer en base de données
        $pass = $user->generateCSRFtoken();
        $user->mail = $mail;
        $user->pass = password_hash($pass, PASSWORD_BCRYPT);
        $user->updatePassMail();
        $user->mailconnect = $mail;
        $userInfo = $user->getUserMail();
        $headers = "MIME-Version: 1.0\r\n";
//header mail avec ces paramêtres
        $headers .= 'From: lacapsulememorial@gmail.com' . "\n";
        $headers .= 'Content-Type:text/html; charset=utf-8' . "\n";
        $headers .= 'Content-Transfer-Encoding: 8bit';
// Contenu du mail 
        $message = '<html>'
                 . '<style>'
          . ' .center {
          text-align: center;
          }
          .success {
          color: green;
          }
          .warning {
          color: red;
          }'
          . '</style>'
                . '<body>'
                . '<div>Nouveau mot de passe :<h1 class="success center"> ' . $pass . '</h1></div>'
                . '<div><h2 class="warning center">Penssez a modifier votre mot de passe dans votre espace profil->menu->paramêtre->modifier mon mot de passe</h2></div>'
                . '</body>'
                . '</html>';
//function qui envoie un mail avec les identifiants de l'utilisateur
        mail($mail, "Nouveau mot de passe", $message, $headers);
          echo '<script>window.location.href="index.php";</script>';
    }
}
?>
