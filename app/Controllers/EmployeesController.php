<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Employees;
use CodeIgniter\Exceptions\PageNotFoundException;

class EmployeesController extends BaseController
{
    protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new Employees();
    }
    public function index()
    {
        $employees = $this->employeeModel->findAll();

        return view('admin/employees/index', ['employees' => $employees]);

    }
    public function create()
    {
        return view('admin/employees/create');
    }
    public function store()
    {
        $nacionalidad = $this->request->getPost('nacionalidad');
        $cedula = $this->request->getPost('cedula');
        $cedulaCompleta = $nacionalidad . '-' . $cedula;

        $existeCedula = $this->employeeModel->where('cedula', $cedulaCompleta)->first();

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
            'primer_nombre' => [
                'label' => 'Primer Nombre',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_nombre' => [
                'label' => 'Segundo Nombre',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'primer_apellido' => [
                'label' => 'Primer Apellido',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_apellido' => [
                'label' => 'Segundo Apellido',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'fecha_ingreso' => [
                'label' => 'Fecha de ingreso',
                'rules' => 'required|valid_date|not_future_date',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_date' => 'El campo {field} debe contener una fecha válida.',
                    'not_future_date' => 'El campo {field} no puede ser una fecha futura.'
                ]
            ],
            'nivel' => [    
                'label' => 'Nivel',
                'rules' => 'required|in_list[inicial,primaria,media general]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El {field} debe ser uno de los siguientes valores: Inicial, Primaria, Media General'
                ]
            ],
            'cargo' => [
                'label' => 'Cargo',
                'rules' => 'required|in_list[directivo,subdirectivo,coordinador,administrativo,docente,obrero]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El {field} debe ser uno de los siguientes valores: Directivo, Subdirectivo, Coordinador, Administrativo, Docente, Obrero'
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
            'primer_nombre' => $this->request->getPost('primer_nombre'),
            'primer_apellido' => $this->request->getPost('primer_apellido'),
            'fecha_ingreso' => $this->request->getPost('fecha_ingreso'),
            'nivel' => ucwords(strtolower($this->request->getPost('nivel'))),
            'position' => ucwords(strtolower($this->request->getPost('cargo'))),
            'turn' => ucwords(strtolower($this->request->getPost('turno'))),
            'active' => true,
        ];

        // Solo agregar segundo_nombre si no está vacío o nulo
        if (!empty($this->request->getPost('segundo_nombre'))) {
            $data['segundo_nombre'] = $this->request->getPost('segundo_nombre');
        }

        // Solo agregar segundo_apellido si no está vacío o nulo
        if (!empty($this->request->getPost('segundo_apellido'))) {
            $data['segundo_apellido'] = $this->request->getPost('segundo_apellido');
        }

        $this->employeeModel->insert($data);

        //log_message('error', 'Error en la inserción: ' . json_encode($this->userModel->errors()));

        return redirect()->to('/admin/employees/create')->with('employeeCreated', '¡Trabajador añadido con éxito!');
    }
    public function view($id)
    {
        $employee = $this->employeeModel->find($id);
        if(!$employee) {
            throw PageNotFoundException::forPageNotFound("Trabajador no encontrado");
        }

        return view('admin/employees/view', ['employee' => $employee]);
    }
    public function edit($id)
    {
        $employee = $this->employeeModel->find($id);
        if(!$employee) {
            throw PageNotFoundException::forPageNotFound("Trabajador no encontrado");
        }

        return view('admin/employees/edit', ['employee' => $employee]);

    }
    public function update($id)
    {
        $employee = $this->employeeModel->find($id);
        if(!$employee) {
            throw PageNotFoundException::forPageNotFound("Trabajador no encontrado");
        }

        $nacionalidad = $this->request->getPost('nacionalidad');
        $cedula = $this->request->getPost('cedula');
        $cedulaCompleta = $nacionalidad . '-' . $cedula;

        $rules = [
            'cedula' => [
                'label' => 'Cédula',
                'rules' => 'required|regex_match[/^[0-9]{6,9}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'La {field} debe contener entre 6 y 9 dígitos numéricos.',
                ]
            ],
            'primer_nombre' => [
                'label' => 'Primer Nombre',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_nombre' => [
                'label' => 'Segundo Nombre',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'primer_apellido' => [
                'label' => 'Primer Apellido',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]+$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'segundo_apellido' => [
                'label' => 'Segundo Apellido',
                'rules' => 'regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ\s]*$/]',  // Permite letras, acentos y tildes
                'errors' => [
                    'regex_match' => 'El {field} solo puede contener letras y espacios.'
                ]
            ],
            'fecha_ingreso' => [
                'label' => 'Fecha de ingreso',
                'rules' => 'required|valid_date|not_future_date',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_date' => 'El campo {field} debe contener una fecha válida.',
                    'not_future_date' => 'El campo {field} no puede ser una fecha futura.'
                ]
            ],
            'nivel' => [    
                'label' => 'Nivel',
                'rules' => 'required|in_list[inicial,primaria,media general]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'in_list' => 'El {field} debe ser uno de los siguientes valores: Inicial, Primaria, Media General'
                ]
            ],
            'cargo' => [
                'label' => 'Cargo',
                'rules' => 'required|in_list[directivo,subdirectivo,coordinador,administrativo,docente,obrero]',
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

        if (!$this->validate($rules)) {
            $errores = $this->validator->getErrors();
        } else {
            $errores = [];
        }
        
        // Verificación manual de duplicados
        if ($employee['cedula'] !== $cedulaCompleta) {
            $existeCedula = $this->employeeModel->where('cedula', $cedulaCompleta)->first();
            if ($existeCedula) {
                $errores['cedula'] = 'La cédula ya está registrada en el sistema.';
            }
        }
                
        // Si hay errores, los mostramos todos juntos
        if (!empty($errores)) {
            return redirect()->back()->withInput()->with('errores', $errores);
        }

        $data = [
            'cedula' => $cedulaCompleta,
            'primer_nombre' => $this->request->getPost('primer_nombre'),
            'primer_apellido' => $this->request->getPost('primer_apellido'),
            'fecha_ingreso' => $this->request->getPost('fecha_ingreso'),
            'nivel' => ucwords(strtolower($this->request->getPost('nivel'))),
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

        $this->employeeModel->update($id, $data);

        return redirect()->to('admin/employees/' . $id . '/edit')->with('employeeUpdated', '¡Trabajador actulizado con éxito!');
    }

    public function toggleStatus($id)
    {
        if(!$this->request->isAJAX()) {
            return $this->response->setJSON([
                'sucess' => false,
                'message' => 'Acceso no permitido'
            ]);
        }

        $employee = $this->employeeModel->find($id);

        if(!$employee) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Trabajador no encontrado'
            ]);
        }

        $newStatus = $employee['active'] ? 0 : 1;

        $this->employeeModel->update($id, ['active' => $newStatus]);

        return $this->response->setJSON([
            'success' => true,
            'message' => $newStatus ? 'Trabajador activado correctamente' : 'Trabajador desactivado correctamente' 
        ]);
    }
}
