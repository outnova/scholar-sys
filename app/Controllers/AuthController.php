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
        $userModel = new Users();

        $nacionalidad = $this->request->getPost('nacionalidad');
        $cedula = $this->request->getPost('cedula');
        $cedulaCompleta = $nacionalidad . '-' . $cedula;

        $existeCedula = $userModel->where('cedula', $cedulaCompleta)->first();

        $rules = [
            'cedula' => [
                'label' => 'Cédula',
                'rules' => 'required|regex_match[/^[0-9]{6,9}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'La {field} debe contener entre 6 y 9 dígitos numéricos.',
                    'is_unique' => 'La {field} ya está registrada en el sistema.'
                ]
            ],
            'username' => [
                'label' => 'Usuario',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'is_unique' => 'El {field} ya está en uso, prueba con otro.'
                ]
            ],
            'email' => [
                'label' => 'Correo Electrónico',
                'rules' => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'valid_email' => 'El {field} no tiene un formato válido.',
                    'is_unique' => 'El {field} ya está registrado.'
                ]
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' =>  'required|min_length[8]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos 8 caracteres.'
                ]
            ]
        ];

        if($existeCedula) {
            return redirect()->back()->withInput()->with('errores', ['cedula' => 'La cédula ya está registrada en el sistema.']);
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        $data = [
            'cedula' => $cedulaCompleta,
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
            session()->setFlashdata('error', 'Credenciales inválidas. Inténtalo de nuevo.');
            return redirect()->to('/login');
            //return redirect()->back()->with('error', 'Credenciales inválidas');
        }

        if($user['active'] == 0) {
            session()->setFlashdata('error', 'Tu cuenta aún no ha sido aprobada por el administrador.');
            return redirect()->to('/login');
            //return redirect()->back()->with('error', 'Este usuario necesita ser aprobado por el administrador.');
        }

        $sessionData = [
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'position'  => $user['position'], //session()->set('position', $newPosition);
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
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/home');
        }
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Sesión cerrada');
    }
}
