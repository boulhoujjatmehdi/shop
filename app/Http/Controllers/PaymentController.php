<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//list of uses
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

class PaymentController extends Controller
{
    private $apiContext;
    private $secret;
    private $clientId;

    public function __construct()
    {
        if(config('paypal.settings.mode')=='live'){
            $this ->clientId = config('paypal.live_client_id');
            $this ->secret = config('paypal.live_secret');
        }else{
            $this ->clientId = config('paypal.sandbox_client_id');
            $this ->secret = config('paypal.sandbox_secret');
        }
        $this->apiContext = new ApiContext(new OAuthTokenCredential($this->clientId , $this->secret)) ;
        $this->apiContext->setConfig(config('paypal.settings'));
    }



    public function PayWithPaypal (Request $request ){
        $total = $request->input('price');
        $name = $request->input('name');

        // return $total .'      '.$name;


        //set payer
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        
        //item(s)
        $item1 = new Item();
        $item1->setName('name')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($total);


        $itemList = new ItemList();
        $itemList->setItems([$item1]);


        //amount
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($total);
        
        //transactions
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("pay this cart of fash. ");


        //redirect urls
        // $redirectUrls = new RedirectUrls();
        // $redirectUrls->setReturnUrl("http://127.0.0.1:8000/pay")
        //     ->setCancelUrl("http://127.0.0.1:8000/pay");

        $redirectUrls= new RedirectUrls();
        $redirectUrls->setReturnUrl("http://127.0.0.1:8000/status")
                        ->setCancelUrl("http://127.0.0.1:8000/canceled");
        
        
        //payment
        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
        }
         catch (PayPal\Exception\PayPalConnectionException $ex) {
            die($ex);
        }
        $approvalUrl= $payment->getApprovalLink();
        return redirect($approvalUrl);
        
    }
    public function status(Request $request){
        if(empty($request->get('PayerID'))|| empty($request->get('token'))){
            die('Payment Failed');
        }
        $paymentId = $request->get('paymentId');
        $payment = Payment::get($paymentId , $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result= $payment->execute($execution,$this->apiContext);



        if ($result->getState() == 'approved'){
            die('thank you. got your money bitch!');
        }
        echo 'payment failed again';
        die($result);

     }
    public function canceled(){
        return 'payment Canceled. No Worries';
     }

}
