<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Checkout;

class BillingController extends Controller
{
    public function index() {
        /** @var User $user */
        $user = Auth::user();
//        dump($user->subscription()->asStripeSubscription());
//        dump(Carbon::createFromTimestamp($user->subscription()->asStripeSubscription()->current_period_end));
        $checkoutPlan1 = $user->checkout('price_1JjmGFIVVeFoUlextLV5TtKx', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription'
        ]);
        $checkoutPlan2 = Auth::user()->checkout('price_1JjmMdIVVeFoUlexQemVHPrn', [
            'success_url' => route('dashboard'),
            'cancel_url' => route('dashboard'),
            'mode' => 'subscription'
        ]);

        return view('billing', ['checkout1' => $checkoutPlan1, 'checkout2' => $checkoutPlan2]);
    }

    public function cancel() {
        /** @var User $user */
        $user = Auth::user();

        $user->subscription()->cancel();

        return redirect()->back();
    }

    public function resume() {
        /** @var User $user */
        $user = Auth::user();

        $user->subscription()->resume();

        return redirect()->back();
    }
}
