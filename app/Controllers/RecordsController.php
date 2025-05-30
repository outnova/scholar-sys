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

        $data = ['type' => $type];

        if($slug == 'trabajo') {
            $employeesModel = new Employees();
            $data['employees'] = $employeesModel->findAll();
        }

        if (!is_file(APPPATH . "Views/records/forms/{$slug}.php")) {
            throw PageNotFoundException::forPageNotFound("No se encontró el formulario para el tipo '{$slug}'.");
        }
    
        return view("records/forms/{$slug}", $data);
    }
}
