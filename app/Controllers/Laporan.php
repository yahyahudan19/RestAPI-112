<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LaporanModel;

class Laporan extends ResourceController
{
    use ResponseTrait;

    // Get All Laporan
    public function index()
    {
        $model = new LaporanModel();
        $data = $model->findAll();
        return $this->respond($data, 200);
    }

    // Get Single Laporan
    public function show($id = null)
    {
        $model = new LaporanModel();
        $data = $model->getWhere(['id_pelapor' => $id])->getResult();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :(' . $id);
        }
    }

    // Delete Laporan
    public function delete($id = null)
    {
        $model = new LaporanModel();
        $data = $model->find($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data Mboten ditemukan :( ' . $id);
        }
    }
}