<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class CustomVerificationTokenController extends Controller
{
    #======================================================================CVT

    #-----------------notice-----------------
    public function notice(Request $request)
    {
        return $request->user('merchant')->hasVerifiedEmail()
            ? to_route('merchant.index')
            : view('merchant.auth.verify-email');
    }

    #-----------------verify-----------------
    public function verify(Request $request)
    {
        $merchant = Merchant::where('verification_token', $request->token)->firstOrFail();
        if (now() < $merchant->verification_token_till) {
            $merchant->verifyUsingVerificationToken();
            return to_route('merchant.index');
        }
        abort(401);
    }

    #-----------------resend-----------------
    public function resend(Request $request)
    {
        if ($request->user('merchant')->hasVerifiedEmail()) {
            return to_route('merchant.index');
        }

        $request->user('merchant')->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
