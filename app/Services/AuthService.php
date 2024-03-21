<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $apiUriBase;

    public function __construct() {
        $base = env('APP_API_URI_BASE');
        if (!empty($base)) {
            $this->apiUriBase = $base .= '/token';
        }
    }
    
    public function login($email, $password) {
        $data = [
            'email' => $email,
            'password' => $password
        ];

        try {
            $response = Http::post($this->apiUriBase, $data);
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
        } catch (Exception $e) {
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
