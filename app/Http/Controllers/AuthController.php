<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    protected $service;

    public function login() {
        return view('auth.login');
    }

    public function __construct(AuthService $service) {
        $this->service = $service;
    }

    public function check(Request $request) {
        $email = $request['email'];
        $password = $request['password'];

        $result = $this->service->login($email, $password);
        return $result ? redirect()->route('home') : redirect()->back();

    }

    public function logout() {
        $this->service->logout();
        return redirect()->route('login');
    }
}
