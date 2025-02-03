<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        //$seeder = \Config\Database::seeder();
        //$seeder->call('UserSeeder');

        return view('auth/login');
    }
}
