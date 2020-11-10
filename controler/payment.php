<?php
require  '../vendor/autoload.php';
$ids = require ('../paypal.php');
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);
$list = new \PayPal\Api\ItemList();
$item = (new \PayPal\Api\Item())
    ->setName('QrMemorial')
    ->setPrice(7.99)
    ->setCurrency('EUR')
    ->setQuantity(1);
$list->addItem($item);

$details = (new PayPal\Api\Details())
    ->setSubtotal(7.99);
  //  ->setTax(3);
   // ->setShipping(3)
   // ->setInsurance(1)
   // ->setShippingDiscount(1)
   // ->setHandlingFee(1);

$amount = (new \PayPal\Api\Amount())
    ->setTotal(7.99)
    ->setCurrency('EUR')
    ->setDetails($details);

$transaction = (new PayPal\Api\Transaction())
    ->setItemList($list)
    ->setDescription('Kit QrMemorial')
    ->setAmount($amount)
    ->setCustom('transact');

$payment = new \PayPal\Api\Payment();
$payment->setTransactions([$transaction]);
$payment->setIntent('sale');
$redirectUrls = (new \PayPal\Api\RedirectUrls())
    ->setReturnUrl('http://localhost/lacapsule/controler/pay.php')
    ->setCancelUrl('http://localhost/lacapsule/404.php');
$payment->setRedirectUrls($redirectUrls);
$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));
try {
    $payment->create($apiContext);
    echo json_encode([
        'id' => $payment->getId()
    ]);
    //header('location:'.$payment->getApprovalLink());
}catch (\PayPal\Exception\PayPalConnectionException $e){
    var_dump(json_decode($e->getData()));
}