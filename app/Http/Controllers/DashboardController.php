<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            if (auth()->user()->hasRole("admin")) {
                return redirect(route("admin.order.list"));
            }
        }
        return redirect(route("order.new"));
    }

    public function checkPaymentStatus() {
        \MercadoPago\SDK::setAccessToken(env('PIX_ACCESS_TOKEN'));
        $paymentResult = \MercadoPago\SDK::get('/v1/payments/75881384820');
        // $status = $paymentResult['body']['status'];
        return $paymentResult['body'];
    }
}
