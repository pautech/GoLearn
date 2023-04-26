<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Exception;
use Socialite;

class GoogleSocialiteController extends Controller
{   //login with google
    public function redirectToGoogle()
    {
        // redirect user to "login with Google account" page
        return Socialite::driver('google')->redirect();
    }

    public function handleCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('google')->user();

            // find user in the database where the social id is the same with the id provided by Google
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in
                Auth::login($finduser);

                // redirect user to dashboard page
                return redirect('/dashboard');
            }
            else
            {
                // if user not found then this is the first time he/she try to login with Google account
                // create user data with their Google account data
                $newUser = User::create([
                    'social_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username'=> bcrypt('my-google-username'),
                    'social_type' => 'google',  // the social login is using google
                    'password' => bcrypt('my-google'),  // fill password by whatever pattern you choose
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }
    //login with Github

    public function redirectToGithub()
    {
        // redirect user to "login with Google account" page
        return Socialite::driver('github')->redirect();
    }

    public function githubCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('github')->user();

            // find user in the database where the social id is the same with the id provided by Google
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in
                Auth::login($finduser);

                // redirect user to dashboard page
                return redirect('/dashboard');
            }
            else
            {
                // if user not found then this is the first time he/she try to login with Google account
                // create user data with their Google account data
                $newUser = User::create([
                    'social_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => bcrypt('my-github-username'),
                    'social_type' => 'github ',  // the social login is using google
                    'password' => bcrypt('my-google'),  // fill password by whatever pattern you choose
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }


    //login with Facebook

    public function redirectTofacebook()
    {
        // redirect user to "login with facebook account" page
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {
            // get user data from Google
            $user = Socialite::driver('facebook')->stateless()->user();

            // find user in the database where the social id is the same with the id provided by facebook
            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser)  // if user found then do this
            {
                // Log the user in
                Auth::login($finduser);

                // redirect user to dashboard page
                return redirect('/dashboard');
            }
            else
            {
                // if user not found then this is the first time he/she try to login with Google account
                // create user data with their Google account data
                $newUser = User::create([
                    'social_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' =>bcrypt('my-facebook-username'),
                    'social_type' => 'facebook ',  // the social login is using google
                    'password' => bcrypt('my-facebook'),  // fill password by whatever pattern you choose
                ]);

                Auth::login($newUser);

                return redirect('/dashboard');
            }

        }
        catch (Exception $e)
        {
            dd($e->getMessage());
        }
    }
}