<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $apiUriBase = 'https://symfony-skeleton.q-tests.com/api/v2/token';
    
    public function login($email, $password) {
        $data = [
            'email' => $email,
            'password' => $password
        ];

        $response = Http::post('https://symfony-skeleton.q-tests.com/api/v2/token', $data);
        if($response->successful()) {
            session([
                'token_key' => $response['token_key'], 
                'username' => $response['user']['first_name'] . ' ' . $response['user']['last_name'],
                'expiration_time' => now()->addMinutes(90)
            ]);
            return $response['token_key'];
        } else {
            return false;
        }
    }

    public function logout() {
        session()->forget('token_key');
        session()->forget('username');
    }

    public function getUserName() {
        return session('username');
    }
}
