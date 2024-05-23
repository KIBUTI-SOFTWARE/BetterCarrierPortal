<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function dashboard(): string
    {
        return view('dashboard');
    }

}
