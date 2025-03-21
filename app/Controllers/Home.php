<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //$seeder = \Config\Database::seeder();
        //$seeder->call('UserSeeder');

        return view('home');
    }
}
