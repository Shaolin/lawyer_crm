<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    // Redirect to Paystack
    public function redirectToGateway()
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    // Handle Paystack callback
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // You’ll get transaction data here
        // Example: Save payment to DB
        // dd($paymentDetails);

        return redirect()->route('dashboard')->with('success', 'Payment successful!');
    }
}
