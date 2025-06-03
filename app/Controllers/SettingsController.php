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
            'school_longcity' => $settingsModel->getSetting('school_longcity'),
            'school_shortcity' => $settingsModel->getSetting('school_shortcity'),
            'school_footeraddress' => $settingsModel->getSetting('school_footeraddress'),
            'school_footercity' => $settingsModel->getSetting('school_footercity'),
            'principal_name' => $settingsModel->getSetting('principal_name'),
            'principal_ci' => $settingsModel->getSetting('principal_ci'),
            'principal_position' => $settingsModel->getSetting('principal_position'),
            'principal_phone' => $settingsModel->getSetting('principal_phone'),
            'dea_code' => $settingsModel->getSetting('dea_code'),
            'depend_code' => $settingsModel->getSetting('depend_code'),
        ];

        return view ('admin/settings/index', $data);
        //
    }

    public function update()
    {
        $settingsModel = new Settings();

        $nacionalidad = $this->request->getPost('principal_nacionalidad');
        $cedula = $this->request->getPost('principal_ci');
        
        // Elimina cualquier punto o guión por si acaso vienen del input
        $cedulaLimpia = preg_replace('/[^0-9]/', '', $cedula);
        
        // Formatea la cédula con puntos (ej: 12345678 → 12.345.678)
        $cedulaFormateada = number_format($cedulaLimpia, 0, '', '.');
        
        // Combina con la nacionalidad
        $cedulaCompleta = $nacionalidad . '-' . $cedulaFormateada;

        $rules = [
            'system_name' => [
                'label' => 'Nombre del Sistema',
                'rules' => 'required|regex_match[/^[a-zA-Z\s]{1,16}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras sin acentos, espacios y un máximo de 16 caracteres.'
                ]
            ],
            'school_name' => [
                'label' => 'Nombre de la Escuela',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ"]{1,64}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, espacios, puntos, comillas y un máximo de 64 caracteres.'
                ]
            ],
            'dea_code' => [
                'label' => 'Código DEA',
                'rules' => 'required|regex_match[/^[A-Z0-9]{9,15}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} debe contener entre 9 y 15 caracteres alfanuméricos (solo mayúsculas y números).',
                ]
            ],
            'depend_code' => [
                'label' => 'Código de Dependencia',
                'rules' => 'required|regex_match[/^[0-9]{9,15}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'La {field} debe contener entre 9 y 15 dígitos numéricos.',
                ]
            ],
            'school_address' => [
                'label' => 'Dirección',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.'
                ]
            ],
            'school_footeraddress' => [
                'label' => 'Dirección (pie de página / footer)',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ0-9\s.,;ºñÑ]{1,200}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, números, espacios, puntos, comas, punto y coma, º y un máximo de 200 caracteres.'
                ]
            ],
            'school_footercity' => [
                'label' => 'Ciudad (pie de página / footer)',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,100}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, espacios, comas y un máximo de 100 caracteres.'
                ]
            ],
            'school_longcity' => [
                'label' => 'Ciudad de la Escuela (Larga)',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,100}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, espacios, comas y un máximo de 100 caracteres.'
                ]
            ],
            'school_shortcity' => [
                'label' => 'Ciudad de la Escuela (Corta)',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ,\sñÑ]{1,64}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, espacios, comas y un máximo de 64 caracteres.'
                ]
            ],
            'school_phone' => [
                'label' => 'Teléfono',
                'rules' => 'required|regex_match[/^[0-9]{10,13}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'La {field} debe contener entre 10 y 13 dígitos numéricos.',
                ]

            ],
            'school_email' => [
                'label' => 'Correo Electrónico',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El {field} es obligatorio.',
                    'valid_email' => 'El {field} no tiene un formato válido.',
                ]
            ],
            'principal_name' => [
                'label' => 'Nombre del Director',
                'rules' => 'required|regex_match[/^[a-zA-ZáéíóúÁÉÍÓÚüÜ.\sñÑ]{1,64}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'El {field} solo puede contener letras, espacios, puntos y un máximo de 64 caracteres.'
                ]
            ],
            'principal_ci' => [
                'label' => 'Cédula del Director',
                'rules' => 'required|regex_match[/^[0-9]{6,9}$/]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'regex_match' => 'La {field} debe contener entre 6 y 9 dígitos numéricos.',
                ]
            ]
        ];

        $data = [
            'system_name' => $this->request->getPost('system_name'),
            'school_name' => $this->request->getPost('school_name'),
            'dea_code' => $this->request->getPost('dea_code'),
            'depend_code' => $this->request->getPost('depend_code'),
            'school_address' => $this->request->getPost('school_address'),
            'school_longcity' => $this->request->getPost('school_longcity'),
            'school_shortcity' => $this->request->getPost('school_shortcity'),
            'school_footeraddress' => $this->request->getPost('school_footeraddress'),
            'school_footercity' => $this->request->getPost('school_footercity'),
            'school_phone' => $this->request->getPost('school_phone'),
            'school_email' => $this->request->getPost('school_email'),
            'principal_name' => $this->request->getPost('principal_name'),
            'principal_ci' => $cedulaCompleta,
            'principal_position' => $this->request->getPost('principal_position'),
            'principal_phone' => $this->request->getPost('principal_phone'),
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errores', $this->validator->getErrors());
        }

        foreach($data as $key => $value) {
            $settingsModel->setSetting($key, $value);
        }

        return redirect()->to('admin/settings')->with('success', 'Configuración actualizada correctamente');
    }
}
