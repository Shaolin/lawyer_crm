<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackController extends Controller
{
    // Redirect user to Paystack checkout
    public function redirectToGateway(Request $request)
    {
        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    // Handle Paystack callback after payment
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // You can store payment details in DB here
        // Example: $paymentDetails['data']['reference']

        return view('payments.success', compact('paymentDetails'));
    }
}
