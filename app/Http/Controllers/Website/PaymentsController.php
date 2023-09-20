<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
         if (Auth::user()->id !== $order->user_id){
            abort(404);
        }elseif ($order->payment_status === 'paid') {
             abort("this Order Paid");
         }
        return view('website.content.payments.create', [
            'order' => $order
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {

//        $amount = $order->items->sum(function($item) {
//            return $item->price * $item->quantity;
//        });
//
//        return [
//            '$amount' => $amount
//        ];

        $stripe = App::make('stripe.client');
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $order->total*100,
            'currency' => 'USD',
            'payment_method_types' => ['card'],
        ]);

        try {
            // Create payment
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'method' => 'stripe',
                'status' => 'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),
            ])->save();
        } catch (QueryException $e) {
            echo $e->getMessage();
            return;
        }

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }


    public function confirm(Request $request, Order $order)
    {

        $stripe = App::make('stripe.client');
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );


        if ($paymentIntent->status == 'succeeded') {
            try {
                // Update payment
                $payment = Payment::where('order_id', $order->id)->first();
                $payment->forceFill([
                    'status' => 'completed',
                    'transaction_data' => json_encode($paymentIntent),
                ])->save();

                $order->forceFill([
                    'payment_status' => 'paid',
                    'payment_method' => 'Stripe',
                ])->save();

            } catch (QueryException $e) {
                echo $e->getMessage();
                return;
            }

            event('payment.created', $payment->id);

            return redirect()->route('account')->with('success', "payment Succeeded");
        }

        return redirect()->route('orders.payments.create', [
            'order' => $order->id,
            'status' => $paymentIntent->status,
        ]);

    }
}
