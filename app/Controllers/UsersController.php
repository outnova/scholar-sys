<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Users;

class UsersController extends BaseController
{
    public function index()
    {
        $usersModel = new Users();
        $users = $usersModel->findAll();

        return view('admin/users/index', ['users' => $users]);
        //
    }
    public function create()
    {
        return view('admin/users/create');
    }
    public function store()
    {
        $userModel = new Users();

        $nacionalidad = $this->request->getPost('nacionalidad');
        $cedula = $this->request->getPost('cedula');
        $cedulaCompleta = $nacionalidad . '-' . $cedula;

        $existeCedula = $userModel->where('cedula', $cedulaCompleta)->first();
        $tempPassword = bin2hex(random_bytes(4));
        $hashedPassword = password_hash($tempPassword, PASSWORD_DEFAULT);

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
            /*
            'password' => [
                'label' => 'Contraseña',
                'rules' =>  'required|min_length[8]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos 8 caracteres.'
                ]
            ]*/
            'primer_nombre' => [
                'label' => 'Primer Nombre',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_nombre' => [
                'label' => 'Segundo Nombre',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'primer_apellido' => [
                'label' => 'Primer Apellido',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_apellido' => [
                'label' => 'Segundo Apellido',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'cargo' => [
                'label' => 'Cargo',
                'rules' => 'required|in_list[directivo,subdirectivo,coordinador,administrativo]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El {field} debe ser uno de los siguientes valores: Directivo, Subdirectivo, Coordinador, Administrativo.'
                ]
            ],
            'turno' => [
                'label' => 'Turno',
                'rules' => 'required|in_list[mañana,tarde]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El {field} debe ser "Mañana" o "Tarde".'
                ]
            ],
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
            'password' => $hashedPassword,
            'active' => 1,
            'primer_nombre' => $this->request->getPost('primer_nombre'),
            'primer_apellido' => $this->request->getPost('primer_apellido'),
            'must_change_password' => true,
            'id_role' => 2,
            'position' => ucwords(strtolower($this->request->getPost('cargo'))),
            'turn' => ucwords(strtolower($this->request->getPost('turno')))
        ];

        // Solo agregar segundo_nombre si no está vacío o nulo
        if (!empty($this->request->getPost('segundo_nombre'))) {
            $data['segundo_nombre'] = $this->request->getPost('segundo_nombre');
        }

        // Solo agregar segundo_apellido si no está vacío o nulo
        if (!empty($this->request->getPost('segundo_apellido'))) {
            $data['segundo_apellido'] = $this->request->getPost('segundo_apellido');
        }

        $userModel->insert($data);

        log_message('error', 'Error en la inserción: ' . json_encode($userModel->errors()));

        return redirect()->to('/admin/users/create')->with('tempPassword', $tempPassword);
    }

    public function newPasswordView()
    {
        $userModel = new Users();

        $userId = session()->get('user_id');

        $user = $userModel->select('must_change_password')->where('id', $userId)->first();

        if ($user['must_change_password'] == 'f') {
            return redirect()->to('home');
        }

        return view('new-password');
    }

    public function updateNewPassword()
    {
        $userModel = new Users();

        $userId = session()->get('user_id');

        $newPassword = $this->request->getPost('new_password');
        $confirmPassword = $this->request->getPost('confirm_password');

        $rules = [
            'new_password' => [
                'label' => 'Contraseña',
                'rules' => 'required|min_length[8]|max_length[16]|regex_match[/^(?=.*[A-Z])(?=.*\d)(?=.*[#$.@&])[A-Za-z\d#$.@&]{8,16}$/]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'min_length' => 'La {field} debe tener al menos 8 caracteres.',
                    'max_length' => 'La {field} no puede tener más de 16 caracteres.',
                    'regex_match' => 'La {field} debe incluir al menos una mayúscula, un número y uno de estos símbolos: # $ . @ &.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirmar contraseña',
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'La {field} es obligatoria.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        $data = [
            'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
            'must_change_password' => false,
        ];

        $userModel->update($userId, $data);

        return redirect()->to('/home')->with('success', 'Contraseña actualizada con éxito');
    }
}
