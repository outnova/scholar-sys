<?php

namespace App\Controllers;

use App\Models\Settings;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class SettingsController extends BaseController
{
    public function index()
    {
        $settingsModel = new Settings();
        $data['settings'] = [
            'system_name' => $settingsModel->getSetting('system_name'),
            'school_name' => $settingsModel->getSetting('school_name'),
            'school_address' => $settingsModel->getSetting('school_address'),
            'school_phone' => $settingsModel->getSetting('school_phone'),
            'school_email' => $settingsModel->getSetting('school_email'),
            'principal_name' => $settingsModel->getSetting('principal_name'),
            'principal_ci' => $settingsModel->getSetting('principal_ci'),
        ];

        return view ('admin/settings/index', $data);
        //
    }

    public function update()
    {
        $settingsModel = new Settings();

        $data = [
            'system_name' => $this->request->getPost('system_name'),
            'school_name' => $this->request->getPost('school_name'),
            'school_address' => $this->request->getPost('school_address'),
            'school_phone' => $this->request->getPost('school_phone'),
            'school_email' => $this->request->getPost('school_email'),
            'principal_name' => $this->request->getPost('principal_name'),
            'principal_ci' => $this->request->getPost('principal_ci'),
        ];

        foreach($data as $key => $value) {
            $settingsModel->setSetting($key, $value);
        }

        return redirect()->to('admin/settings')->with('success', 'Configuración actualizada correctamente');
    }
}
