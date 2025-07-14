<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //$seeder = \Config\Database::seeder();
        //$seeder->call('UserSeeder');

        $recordsCount = model('App\Models\Records')->countAll();
        $usersCount = model('App\Models\Users')->countAll();
        $employeeCount = model('App\Models\Employees')->where('active', 1)->countAllResults();

        return view('home', [
            'recordsCount' => $recordsCount,
            'usersCount' => $usersCount,
            'employeeCount' => $employeeCount,
        ]);
    }

    public function recordsData()
    {
        $range = $this->request->getGet('range'); // 'daily', 'weekly', 'monthly'
        $recordsModel = model('App\Models\Records');

        $data = [];

        switch ($range) {
            case 'daily':
                // Últimos 7 días (fecha exacta)
                $builder = $recordsModel->select("TO_CHAR(created_at, 'DD Mon') AS label, COUNT(*) AS total")
                    ->where('created_at >=', date('Y-m-d', strtotime('-6 days')))
                    ->groupBy("label")
                    ->orderBy("MIN(created_at)", 'ASC')
                    ->findAll();
                break;

            case 'two-weeks':
                // Últimos 15 días (fecha exacta)
                $builder = $recordsModel->select("TO_CHAR(created_at, 'DD Mon') AS label, COUNT(*) AS total")
                    ->where('created_at >=', date('Y-m-d', strtotime('-14 days')))
                    ->groupBy("label")
                    ->orderBy("MIN(created_at)", 'ASC')
                    ->findAll();
                break;

            case 'month':
                // Últimos 30 días (fecha exacta)
                $builder = $recordsModel->select("TO_CHAR(created_at, 'DD Mon') AS label, COUNT(*) AS total")
                    ->where('created_at >=', date('Y-m-d', strtotime('-30 days')))
                    ->groupBy("label")
                    ->orderBy("MIN(created_at)", 'ASC')
                    ->findAll();
                break;

            case 'monthly':
            default:
                // Últimos 6 meses (nombre completo del mes)
                $builder = $recordsModel->select("TO_CHAR(created_at, 'Month') AS label, COUNT(*) AS total")
                    ->where('created_at >=', date('Y-m-d', strtotime('-6 months')))
                    ->groupBy("label")
                    ->orderBy("MIN(created_at)", 'ASC')
                    ->findAll();
                break;
        }

        foreach ($builder as $row) {
            $data['labels'][] = $row['label'];
            $data['data'][] = (int)$row['total'];
        }

        return $this->response->setJSON($data);
    }

    public function recordsDataByType()
    {
        $recordsModel = model('App\Models\Records');
        $typesModel = model('App\Models\RecordsTypes');

        // Obtener todos los tipos de constancia
        $types = $typesModel->findAll();

        $data = [];

        foreach ($types as $type) {
            $count = $recordsModel
                ->where('type_id', $type['id']) // Suponiendo que se relacionan así
                ->countAllResults();

            $data[] = [
                'label' => $type['name'], // Ajusta si el campo se llama distinto
                'count' => $count
            ];
        }

        return $this->response->setJSON($data);
    }
}
