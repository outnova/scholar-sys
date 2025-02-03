<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //$seeder = \Config\Database::seeder();
        //$seeder->call('UserSeeder');

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
        } 

        if (current_url() === base_url('/')) {
            return redirect()->to('/home');
        }

        return view('home');
    }
}
