<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Records;
use App\Models\RecordsTypes;
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
}
