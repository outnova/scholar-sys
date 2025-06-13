<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Records;
use App\Models\RecordsTypes;
use App\Models\Employees;
use CodeIgniter\Exceptions\PageNotFoundException;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class RecordsController extends BaseController
{
    protected $recordsModel;

    public function __construct()
    {
        $this->recordsModel = new Records();
    }
    public function index()
    {
        return view('records/index');
        //
    }
    public function create()
    {
        $recordsTypesModel = new RecordsTypes();
        $types = $recordsTypesModel->findAll();
        
        return view('records/create', [
            'types' => $types,
        ]);
    }
    public function createWithType($slug)
    {
        $recordsTypesModel = new RecordsTypes();

        // Verifica si el tipo de registro existe
        $type = $recordsTypesModel->where('slug', $slug)->first();
        if (!$type) {
            throw PageNotFoundException::forPageNotFound("Tipo de registro no encontrado: {$slug}");
            //return redirect()->back()->with('error', 'Tipo de registro no encontrado.');
        }

        // Prioridad: datos por POST (cuando vuelve con errores), luego preview_data
        $formData = [];

        if ($this->request->getMethod() === 'POST') {
            $formData = $this->request->getPost();
        } elseif (session()->has('preview_data')) {
            $previewData = session('preview_data');
            if (($previewData['slug'] ?? null) === $slug) {
                $formData = $previewData;
            }
            session()->remove(['preview_data', 'preview_slug']);
        }

        $data = [
            'type' => $type,
            'slug' => $slug,
            'formData' => $formData,
        ];

        if($slug == 'trabajo') {
            $employeesModel = new Employees();
            $data['employees'] = $employeesModel->where('active', 1)->findAll();
        }

        if (!is_file(APPPATH . "Views/records/forms/{$slug}.php")) {
            throw PageNotFoundException::forPageNotFound("No se encontró el formulario para el tipo '{$slug}'.");
        }
    
        return view("records/forms/{$slug}", $data);
    }
    public function preview()
    {
        $data = $this->request->getPost();

        $slug = $data['slug'] ?? null;

        if (!$slug) {
            return redirect()->back()->with('error', 'Tipo de constancia no especificado.');
        }

        $rules = $this->getValidationRules($slug);
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        session()->set('preview_data', $data);
        session()->set('preview_slug', $slug);

        /*
        return view('records/preview', [
            'data' => $data,
            'slug' => $slug,
        ]);
        */

        // Redirige a la vista GET
        return redirect()->to('records/preview/view');
    }
    public function previewView()
    {
        $data = session()->get('preview_data');
        $slug = session()->get('preview_slug');

        if (!$data || !$slug) {
            return redirect()->to('records/create')->with('error', 'No hay datos para previsualizar.');
        }

        $recordsTypesModel = new RecordsTypes();
        $type = $recordsTypesModel->where('slug', $slug)->first();

        return view('records/preview', [
            'data' => $data,
            'slug' => $slug,
            'type' => $type,
        ]);
    }
    public function store()
    {
        $data = $this->request->getPost();

        $slug = $data['slug'] ?? null;

        if (!$slug) {
            return redirect()->back()->with('error', 'Tipo de constancia no especificado.');
        }

        $recordsTypesModel = new RecordsTypes();
        $type = $recordsTypesModel->where('slug', $slug)->first(); 

        if (!$type) {
            return redirect()->back()->with('error', 'Tipo de constancia inválido.');
        }

        $typeId = $type['id'];

        $rules = $this->getValidationRules($slug);
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $targetCedula = formatCedulaEx($data['cedula'] ?? '', $data['nacionalidad'] ?? '', $data['tipo_cedula'] ?? null);
        $rCedula = formatCedulaEx($data['r-cedula'] ?? '', $data['r-nacionalidad'] ?? '');

        $dataToSave = [
            'type_id' => $typeId ?? null,
            'status' => 'Emitida',
            'subject' => 'Constancia',
            'description' => $type['description'] ?? '',
            'employee_id' => $data['employee_id'] ?? null,
            'created_by' => session()->get('user_id') ?? null,
            'target_pn' => $data['primer_nombre'] ?? '',
            'target_sn' => $data['segundo_nombre'] ?? '',
            'target_pa' => $data['primer_apellido'] ?? '',
            'target_sa' => $data['segundo_apellido'] ?? '',
            'cedula' => $targetCedula ?? '',
            'nivel' => $data['nivel'] ?? '',
            'position' => $data['cargo_funciones'] ?? '',
            'position_code' => $data['codigo_cargo'] ?? '',
            'dependence' => $data['dependencia'] ?? '',
            'dependence_code' => $data['codigo_dependencia'] ?? '',
            'salary' => $data['sueldo_mensual'] ?? '',
            'start_date' => $data['fecha_ingreso'] ?? '',
            'grade' => $data['grado'] ?? '',
            'section' => $data['seccion'] ?? '',
            'level' => $data['nivel'] ?? '',
            'scholar_period' => $data['periodo_escolar'] ?? '',
            'student_age' => $data['edad'] ?? '',
            'birth_city' => $data['birthcity'] ?? '',
            'birth_state' => $data['state'] ?? '',
            'current_course' => $data['cursa_curso'] ?? '',
            'repre_pn' => $data['rprimer_nombre'] ?? '',
            'repre_sn' => $data['rsegundo_nombre'] ?? '',
            'repre_pa' => $data['rprimer_apellido'] ?? '',
            'repre_sa' => $data['rsegundo_apellido'] ?? '',
            'repre_cedula' => $rCedula ?? '',
            'reason' => $data['motivo'] ?? '',
        ];

        // Elimina claves con valor vacío (null, '', o solo espacios)
        $dataToSave = array_filter($dataToSave, function ($val) {
            return $val !== null && trim($val) !== '';
        });

        // Validación y guardado
        if (!$this->recordsModel->insert($dataToSave)) {
            // Obtener errores del modelo
            $errors = $this->recordsModel->errors();

            // Puedes registrar los errores en el log
            log_message('error', 'Error al insertar constancia: ' . print_r($errors, true));

            // Redirigir con mensaje de error
            return redirect()->back()->withInput()->with('error', 'Hubo un problema al guardar la constancia.')->with('validation_errors', $errors);
        }

        // Si llegó aquí, se guardó correctamente

        // Generación del PDF (ej: dompdf, mpdf, etc.)
        // ...

        session()->remove(['preview_data', 'preview_slug']);
        session()->setFlashdata('pdf_data', $data);

        return redirect()->to('records')->with('recordCreated', '¡Constancia generada con éxito!');
    }
    private function getValidationRules(string $slug): array
    {
        $rules = [
            'trabajo' => [
                'cargo_funciones' => 'required|regex_match[/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-]+$/]',
                'codigo_cargo'     => 'required|alpha_numeric',
                'dependencia'     => 'required|regex_match[/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-."”]+$/]',
                'codigo_dependencia' => 'required|numeric',
                'sueldo_mensual'     => 'required|regex_match[/^\d+([.,]\d{1,2})?$/]',
            ],
            'estudio' => [
                'primer_nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_nombre' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'primer_apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_apellido' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'cedula' => 'required|regex_match[/^\d{7,15}$/]',
                'edad' => 'required|regex_match[/^\d{1,2}$/]',
                'birthcity' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'grado' => 'required|regex_match[/^[a-zA-Z0-9ñÑ ]+$/]',
                'seccion' => 'required|regex_match[/^[a-zA-Z]$/]',
                'periodo_escolar' => [
                    'label' => 'Periodo Escolar',
                    'rules' => 'required|regex_match[/^(20\d{2})-(20\d{2})$/]|valid_periodo'
                ],
            ],
            'inscripcion' => [
                'primer_nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_nombre' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'primer_apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_apellido' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'cedula' => 'required|regex_match[/^\d{7,15}$/]',
                'edad' => 'required|regex_match[/^\d{1,2}$/]',
                'birthcity' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'grado' => 'required|regex_match[/^[a-zA-Z0-9ñÑ ]+$/]',
                'seccion' => 'required|regex_match[/^[a-zA-Z]$/]',
                'periodo_escolar' => [
                    'label' => 'Periodo Escolar',
                    'rules' => 'required|regex_match[/^(20\d{2})-(20\d{2})$/]|valid_periodo'
                ],
            ],
            'buena-conducta' => [
                'primer_nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_nombre' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'primer_apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_apellido' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'cedula' => 'required|regex_match[/^\d{7,15}$/]',
                'grado' => 'required|regex_match[/^[a-zA-Z0-9ñÑ ]+$/]',
                'seccion' => 'required|regex_match[/^[a-zA-Z]$/]',
                'periodo_escolar' => [
                    'label' => 'Periodo Escolar',
                    'rules' => 'required|regex_match[/^(20\d{2})-(20\d{2})$/]|valid_periodo'
                ],
            ],
            'retiro' => [
                'primer_nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_nombre' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'primer_apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'segundo_apellido' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'cedula' => 'required|regex_match[/^\d{7,15}$/]',
                'grado' => 'required|regex_match[/^[a-zA-Z0-9ñÑ ]+$/]',
                'seccion' => 'required|regex_match[/^[a-zA-Z]$/]',
                'periodo_escolar' => [
                    'label' => 'Periodo Escolar',
                    'rules' => 'required|regex_match[/^(20\d{2})-(20\d{2})$/]|valid_periodo'
                ],
                'rprimer_nombre' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'rsegundo_nombre' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'rprimer_apellido' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'rsegundo_apellido' => 'permit_empty|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+$/]',
                'r-cedula' => 'required|regex_match[/^\d{7,15}$/]',
                'motivo' => 'required|regex_match[/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/]|max_length[45]',
            ],
            // otros tipos de constancia...
        ];

        return $rules[$slug] ?? [];
    }
    public function generatePdf()
    {
        $data = $this->request->getJSON(true);
        
        $slug = $data['slug'] ?? null;

        if (!$slug) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Slug faltante', 'data' => $data]);
        }

        $recordsTypesModel = new RecordsTypes();
        $type = $recordsTypesModel->where('slug', $slug)->first(); 

        // Validación básica
        if (empty($data)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Datos no recibidos']);
        }

        if (!$type) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Tipo de constancia no encontrado']);
        }

        $html = view('records/previews/pdf_template', ['data' => $data, 'type' => $type], ['saveData' => true]);

        if (empty($html)) {
            return $this->response->setStatusCode(500)->setBody('La vista HTML está vacía.');
        }

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('letter', 'portrait');
        $dompdf->render();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="constancia.pdf"')
            ->setBody($dompdf->output());
    }
}
