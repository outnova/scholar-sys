<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Records;
use App\Models\RecordsTypes;
use App\Models\Employees;
use CodeIgniter\Exceptions\PageNotFoundException;
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
            $data['employees'] = $employeesModel->findAll();
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

        return view('records/preview', [
            'data' => $data,
            'slug' => $slug,
        ]);
    }
    public function store()
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

        session()->remove(['preview_data', 'preview_slug']);

        // Validación y guardado
        //$this->recordsModel->insert($data);

        // Generación del PDF (ej: dompdf, mpdf, etc.)
        // ...

        return redirect()->to('records/success')->with('message', 'Constancia generada con éxito');
    }
    private function getValidationRules(string $slug): array
    {
        $rules = [
            'trabajo' => [
                'cargo_funciones' => 'required|regex_match[/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-"”]+$/]',
                'codigo_cargo'     => 'required|alpha_numeric',
                'dependencia'     => 'required|regex_match[/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s\/\-"”]+$/]',
                'codigo_dependencia' => 'required|numeric',
                'sueldo_mensual'     => 'required|regex_match[/^\d+([.,]\d{1,2})?$/]',
            ],
            // otros tipos de constancia...
        ];

        return $rules[$slug] ?? [];
    }
}
