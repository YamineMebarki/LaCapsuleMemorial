<?php
/**
 * Created by PhpStorm.
 * User: yamine
 * Date: 04/01/20
 * Time: 20:43
 */
$formError = array();
function secure($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = stripcslashes($data);
    return $data;
}
$adresse = '';
$postalCode = '';
$city = '';
$id_ya_users = 0 ;
    if (isset($_POST['buy']) && $_POST['buy'] == 'payer') {
        if (isset($_POST['adresse']) && !empty($_POST['adresse'])) {
            $adresse = htmlspecialchars($_POST['adresse']);
        } else {
            $formError["adresse"] = 'Veuillez renseigner une adresse de livraison';
        }
        if (isset($_POST['postalCode']) && !empty($_POST['postalCode'])) {
            $postalCode = htmlspecialchars($_POST['postalCode']);
        } else {
            $formError["postalCode"] = 'Veuillez renseigner un code postal';
        }
        if (isset($_POST['city']) && !empty($_POST['city'])) {
            $city = htmlspecialchars($_POST['city']);
        } else {
            $formError["city"] = 'Veuillez renseigner une ville';
        }
        if (isset($_POST['id_ya_users']) && !empty($_POST['id_ya_users'])) {
            $id_ya_users = htmlspecialchars($_POST['id_ya_users']);
        } else {
            $formError["id_ya_users"] = 'Un probleme est survenue merci de reessayer ulterieurement ';
        }
        $statePaypal = new users();
        $statePaypal->id = $_SESSION['id'];
        $state = $statePaypal->verifyPaypal();
        if ($state == false) {
            if (empty($formError)) {
                $paypal = new users();
                $token = $paypal->generateCSRFToken();
                $paypal->adresse = $adresse;
                $paypal->postalCode = $postalCode;
                $paypal->city = $city;
                $paypal->datehour = date('d-m-Y H:i:s');
                $paypal->id_ya_users = $id_ya_users;
                $paypal->insertPaypal();
                echo '<script>window.location.href="index.php?paypal=buy";</script>';
            }
        } else {
            echo '<script>window.location.href="error-404.php";</script>';
        }
    }