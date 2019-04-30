<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
     /**
     * Update the authenticated user's API token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function updateToken(Request $request)
    {
        $user = Auth::user();

        $token = uniqid($user->id);

        $request->user()->forceFill([
            // 'api_token' => hash('sha256', $token),
            'api_token' => $token
        ])->save();

        return ['token' => $token];
    }
}
