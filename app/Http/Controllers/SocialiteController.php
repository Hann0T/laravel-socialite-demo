<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectGithub()
    {
        return Socialite::driver('github')
            //->scopes(['read:user', 'public_repo']) // merge scopes
            //->setScopes(['read:user', 'public_repo']) // overwrite scopes
            ->redirect();
    }

    public function callbackGithub()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate(
            [
                'socialite_id' => $githubUser->getId(),
            ],
            [
                'socialite_id' => $githubUser->getId(),
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'token' => $githubUser->token,
                'refresh_token' => $githubUser->refreshToken,
                'expires_in' => $githubUser->expiresIn,
            ]
        );

        Auth::login($user);
        return redirect('/dashboard');
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')
            //->scopes(['read:user', 'public_repo']) // merge scopes
            //->setScopes(['read:user', 'public_repo']) // overwrite scopes
            ->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            [
                'socialite_id' => $googleUser->getId(),
            ],
            [
                'socialite_id' => $googleUser->getId(),
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'token' => $googleUser->token,
                'refresh_token' => $googleUser->refreshToken,
                'expires_in' => $googleUser->expiresIn,
            ]
        );

        Auth::login($user);
        return redirect('/dashboard');
    }
}
