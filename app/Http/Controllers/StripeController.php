<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function getSession(Request $request)
    {
		try {
			$stripe = new \Stripe\StripeClient('sk_test_51O1pVyJfTkkiwhMIfFQcTrOWfy58vJda15veAIrNgb12xIXVlr4XzdifCS8RQHjYNl7V73nSXRjkCP1rdLrQUUhI00EvyThYfv');

			$session = $stripe->checkout->sessions->create([
				'payment_method_types' => ['card'],
				'line_items' => [[
					'price_data' => [
						'currency' => 'usd',
						'product_data' => [
							'name' => 'MARBLE DUMBELL',
						],
						'unit_amount' => 24900,
					],
					'quantity' => 1,
				]],
				'mode' => 'payment',
				'success_url' => "/",
				'cancel_url' => "/",
			]);

			return response()->json($session->id);
		}
		catch (\Exception $e) {
			return response()->json(['message' => 'Stripe API error: ' . $e->getMessage()], 500);
		}
    }
}
