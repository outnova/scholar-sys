<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function index()
    {
        $usersModel = new \App\Models\Users();
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
        
    }
}
