<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;
use MercadoPago\SDK;

class OrderController extends Controller
{
    public function payment(){
        $mercadopago = new SDK();
        $mercadopago->setAccessToken(config('services.mercadopago.token'));
        return Inertia::render('Payment');
    }
}
