<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Models\PlanOrder;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{



    public function updateStatus(Request $request)
    {
        $data = $request->all();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => 1000, // $10
                'currency' => 'usd',
                'source' => $data['stripeToken'], // Stripe token from frontend
                'description' => 'Payment for order #' . $data['order_id'],
            ]);

            // التأكد من نجاح العملية
            if ($charge->status === 'succeeded') {
                $order = PlanOrder::find($data['order_id']);
                if ($order) {
                    $order->isPaid = true;
                    $order->save();
                }

                return response()->json(['success' => true, 'charge' => $charge]);
            } else {
                return response()->json(['success' => false, 'message' => 'Payment not completed']);
            }

        } catch (\Exception $e) {
            Log::error('Stripe charge error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Payment failed: ' . $e->getMessage()]);
        }
    }

}
