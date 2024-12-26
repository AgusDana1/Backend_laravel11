<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // membuat redirect to google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();

            // check kondisi findUser
            if ($findUser) {
                Auth::login($findUser);
                return redirect()->intended('dashboard');
            }else {
                // membuat user baru
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('4576dummy'),
                ]);

                // memberikan authh kepada user baru
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
            // check apakah data bisa muncul menggunakan dd
        }catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
