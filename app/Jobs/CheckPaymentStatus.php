<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckPaymentStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orders = \App\Models\Orders::where('payment_status', 0)->get();
        \MercadoPago\SDK::setAccessToken(env('PIX_ACCESS_TOKEN'));

        foreach($orders as $order) {
            $paymentResult = \MercadoPago\SDK::get("/v1/payments/$order->payment_id");
            $status = $paymentResult['body']['status'];

            if ($status == 'approved') {
                $order->payment_status = 1;
                $order->save();
            }
        }
        

        // \MercadoPago\SDK::setAccessToken(env('PIX_ACCESS_TOKEN'));

        // $paymentService = new \MercadoPago\Payment();

        // $payments = collect($paymentService->search());

        // if ($payments->isEmpty()) {
        //     // No payments attempt made

        //     return;
        // }

        // $merchantOrder = \MercadoPago\MerchantOrder::read();

        // $paidAmount = collect($merchantOrder->payments)
        //     ->filter(function ($payment) {
        //         return $payment->status === 'approved';
        //     })
        //     ->sum('transaction_amount');

        // // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
        // if ($paidAmount >= $merchantOrder->total_amount) {
        //     // Fully paid!
        // } else {
        //     // Not paid yet
        // }
    }
}