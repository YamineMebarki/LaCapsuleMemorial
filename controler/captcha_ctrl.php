<?php
// A la confirmation du captcha
if (isset($_POST['confirmCaptcha'])) {
    // Si les données retourner est different de vide alor
    if (!empty($_POST['string1'])) {
        //J'initialise une variable qui stockera mon POST une fois securisé
        $string1 = htmlspecialchars($_POST['string1']);
        // Même traitement que les données du dessus
        if (!empty($_POST['string2'])) {
            $string2 = htmlspecialchars($_POST['string2']);
            //Enfin si la donnée 1 est égal à la donnée 2 alor
            if ($string1 == $string2) {
                echo true;
            } else {
                echo false;
            }
        } else {
            echo false;
        }
    } else {
        echo false;
    }
}
?>