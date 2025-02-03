<?php

namespace App\Controllers;

use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class AuthController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }

    public function store()
    {
        $rules = [
            'cedula' => 'required|is_unique[users.cedula]',
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|is_unique[users.email]',
            'password' => 'required|min_lenght[8]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        $userModel = new Users();
        $data = [
            'cedula' => $this->request->getPost('cedula'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'active' => 0,
        ];

        $userModel->insert($data);
        return redirect()->to('/login')->with('message', 'Registro exitoso. Espera la aprobación del administrador.');

        //
    }

    public function authenticate()
    {
        $userModel = new Users();
        $user = $userModel->where('username', $this->request->getPost('username'))->first();

        if(!$user || !password_verify($this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->with('error', 'Credenciales inválidas');
        }

        if($user['active'] == 0) {
            return redirect()->back()->with('error', 'Este usuario necesita ser aprobado por el administrador.');
        }

        $sessionData = [
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'isLoggedIn'=> true
        ];

        session()->set($sessionData);
        return redirect()->to('/home')->with('success', 'Inicio de sesión exitoso');
    }

    public function register() 
    {
        return view('auth/register');
    }

    public function login() 
    {
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada');
    }
}
