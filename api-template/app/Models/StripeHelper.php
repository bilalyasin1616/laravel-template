<?php
namespace App\Models;

class OneTimeStripeModel{
    public $SessionId;
    public $PublishKey;
    public function __construct($SessionId,$PublishKey){
        $this->SessionId = $SessionId;
        $this->PublishKey = $PublishKey;
    }
}

class StripeHelper
{
    public $SecretKey = "sk_test_51I7FPuGmL16qWSWSHFh0GmK5jReWsqVGWH2KeF954SsDvTY3xmRkVt2pzXN92BoCNr3wp3hFlTNSK4OuU2kewwkM00cUpMxtZ5";
    public $PublishKey = "pk_test_51I7FPuGmL16qWSWSGVRCv638RJI1BuN2BECl9Emfw27bjplkWksh4tWOXejValUKnHnW183B7wQJYR6V57YdioAm002JeQm3lK";
    
    public function OneTimePayment(){

        \Stripe\Stripe::setApiKey($this->SecretKey);
        $YOUR_DOMAIN = 'http://localhost:8000';
        $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
            'currency' => 'usd',
            'unit_amount' => 2000,
            'product_data' => [
                'name' => 'Men Ring',
                'images' => ["https://www.turkstyleshop.com/14866-large_default/turquoise-925s-silver-men-s-ring.jpg"],
            ],
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . '/success.html',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);

        $oneTimeStripeModel = new OneTimeStripeModel($checkout_session->id,$this->PublishKey);
        return $oneTimeStripeModel;
    }

    public function Subscription(){

        \Stripe\Stripe::setApiKey($this->SecretKey);
        $YOUR_DOMAIN = 'http://localhost:8000';
        $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price' => "price_1IitVgGmL16qWSWSNU0F8oXS",
            'quantity' => 1,
          ]],
        'mode' => 'subscription',
        'success_url' => $YOUR_DOMAIN . '/success.html',
        'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);
        $oneTimeStripeModel = new OneTimeStripeModel($checkout_session->id,$this->PublishKey);
        return $oneTimeStripeModel;
    }
}