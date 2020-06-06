<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login(Request $request)
    {
//        return response()->json(config('services.passport'));
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('services.passport.login_endpoint'),
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);

        try{
            $response = $client->request('POST', '/oauth/token', [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => 2,
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);

            return $response->getBody();
        }catch(\GuzzleHttp\Exception\BadResponseException $e){
            if ($e->getCode() === 400) {
                return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
            }

            return response()->json('Something went wrong on the server.', $e->getCode());
        }

    }

    public function logout()
    {
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });

        return response()->json('Logged out succefely', 200);
    }
}
