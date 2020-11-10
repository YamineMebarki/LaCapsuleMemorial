<?php
/**
 * Created by PhpStorm.
 * User: yamine
 * Date: 06/01/20
 * Time: 21:49
 */
$formError = array();
function secur($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = strip_tags($data);
    return $data;
}

/**
 * condition ajax formulaire adresse paypal
 */
if (isset($_POST['ajax']) && $_POST['ajax'] == 'ajax' ) {
    if (isset($_POST['adresse']) && !empty($_POST['adresse'])){
        $adresse = htmlspecialchars($_POST['adresse']);
    }else{
        $formError["adresse"] = 'Veuillez renseigner une adresse de livraison';
    }
    if (isset($_POST['postalCode']) && !empty($_POST['postalCode'])){
        $postalCode = htmlspecialchars($_POST['postalCode']);
    }else{
        $formError["postalCode"] = 'Veuillez renseigner un code postal';
    }
    if (isset($_POST['city']) && !empty($_POST['city'])){
        $city = htmlspecialchars($_POST['city']);
    }else{
        $formError["city"] = 'Veuillez renseigner une ville';
    }
    if (isset($_POST['id_ya_users']) && !empty($_POST['id_ya_users'])){
        $id_ya_users = htmlspecialchars($_POST['id_ya_users']);
    }else{
        $formError["id_ya_users"] = 'Un probleme est survenue merci de reessayer ulterieurement ';
    }
    if (empty($formError)) {
        echo true;
    } else {
        echo false;
    }
}