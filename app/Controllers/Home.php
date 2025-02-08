<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //$seeder = \Config\Database::seeder();
        //$seeder->call('UserSeeder');

        $request = service('request'); // Obtiene la solicitud actual

        if (!session()->get('isLoggedIn')) {
            // Si la ruta solicitada es exactamente "/home", mostrar el mensaje de error.
            if ($request->getUri()->getPath() === '/home') {
                return redirect()->to('/login')->with('error', 'Debes iniciar sesión.');
            }

            // Si la ruta es "/", solo redirigir sin mensaje de error.
            return redirect()->to('/login');
        }
        return view('home');
    }
}
