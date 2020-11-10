<?php
/**
 * Created by PhpStorm.
 * User: yamine
 * Date: 20/12/19
 * Time: 17:57
 */
require '../vendor/autoload.php';
$ids = require ('../paypal.php');
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);
$payment = \PayPal\Api\Payment::get($_POST['paymentID'], $apiContext);
$execution = (new \PayPal\Api\PaymentExecution())
    ->setPayerId($_POST["payerID"])
    ->setTransactions($payment->getTransactions());
try{
    $payment->execute($execution, $apiContext);
   echo json_encode([
       'id' => $payment->getId()
   ]);

    // var_dump($payment->getTransactions()[0]->getCustom());
   // var_dump($payment);
}catch (\PayPal\Exception\PayPalConnectionException $e){
    header('HTTP 500 Internal Server Error', true, 500);
    var_dump(json_decode($e->getData()));
}
///Récupére les infos d'une commande
//echo $payment->getPayer()->getPayerInfo()->getEmail();
//var_dump($payment);
