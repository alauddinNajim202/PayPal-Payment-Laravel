<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPaymentController extends Controller
{
    public function index()
    {
        return view('paypal.index');
    }

    public function createPayment(Request $request)
    {
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));

        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([

            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],

            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => $request->currency,
                        "value" => $request->amount,
                    ]
                ]
            ]
        ]);



        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');

        } else {

            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');

        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function paymentCancel()
    {
        return redirect()
            ->route('paypal.index')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }



    /**
     * Write code on Method
     *
     * @return response()
     */

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            return redirect()
                ->route('paypal.index')
                ->with('success', 'Transaction complete.');
        } else {

            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
