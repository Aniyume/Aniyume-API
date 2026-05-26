<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Fake subscribe to premium
     */
    public function subscribeToPremium(Request $request)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $user->update([
            'is_premium' => true
        ]);

        return response()->json([
            'message' => 'Success! You are now a premium user.',
            'user' => $user
        ]);
    }
}
