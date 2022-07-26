<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;

class StripeController extends Controller
{  
    public function stripe()
    {
        return view('stripe');
    }

     public function stripePost()
    {  
        define("usd", "usd");

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => request('amount'),
                "currency" => usd,
                "source" => request('stripeToken'),
                "description" =>  request('description') //"Test payment from tutsmake.com."
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}
