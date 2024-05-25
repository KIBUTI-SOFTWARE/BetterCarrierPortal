<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        //Reserved
    }

    public function profileSetup(): string
    {
        return view('setup-profile');
    }
}
