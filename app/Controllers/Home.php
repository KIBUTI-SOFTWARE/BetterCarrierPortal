<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function forgot_password_1(): string
    {
        return view('forgot-password-1');
    }

    public function forgot_password_2(): string
    {
        return view('forgot-password-2');
    }

    public function forgot_password_3(): string
    {
        return view('forgot-password-3');
    }

    public function resendCode(): string
    {
        return view('resend-code');
    }
}
